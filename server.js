let express = require('express');
let http = require('http');
let path = require('path');
let app = express();
let mysql=require('mysql');
const multer = require('multer');
const jimp = require('jimp');
const fs = require('fs').promises;
const formidable= require('formidable');
let session = require('express-session');

const upload = multer({ dest: 'images/' });
app.set('view engine','ejs');
let server = http.createServer(app);
let db=mysql.createConnection({host:'localhost',user:'root',password:'',database:'agstones',connectTimeout: 10000,
    acquireTimeout: 10000,});
db.on('error', function(err) {
    console.log('MySQL error:', err);
    if (err.code === 'PROTOCOL_CONNECTION_LOST') {
        console.log('Attempting to reconnect to MySQL...');
        db = mysql.createConnection({
            host: 'lolcahost',
            user: 'root',
            password: '',
            database: 'agstones'
        });
    } else {
        throw err;
    }
});
// let db=mysql.createConnection({host:'localhost',user:'root',password:'',database:'products'});
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use('/images', express.static(path.join(__dirname, 'public/images')));
app.use('/assets', express.static(path.join(__dirname, 'public/assets')));
app.use('/css', express.static(path.join(__dirname, 'public/css')));
app.use('/cincy-css', express.static(path.join(__dirname, 'public/cincy-countertops/css')));
app.use('/raleigh-css', express.static(path.join(__dirname, 'public/raleigh-countertops/css')));
app.use('/cincy-images', express.static(path.join(__dirname, 'public/cincy-countertops/images')));
app.use('/raleigh-images', express.static(path.join(__dirname, 'public/raleigh-countertops/images')));
app.use('/admin', express.static(path.join(__dirname, 'public/admin')));
app.use(express.static(path.join(__dirname, 'views')));
app.use(session({
    secret: 'your_secret_here',
    resave: false,
    saveUninitialized: true
}));

app.get('/cincy-countertops', 
  express.static(path.join(__dirname, 'public', 'cincy-countertops')),
  express.static(path.join(__dirname, 'public', 'cincy-countertops', 'images')),
  express.static(path.join(__dirname, 'public', 'cincy-countertops', 'css')),
  (req, res) => {
    // Render the HTML file located in the cincy-countertops folder
    res.sendFile(path.join(__dirname, 'public', 'cincy-countertops', 'index.html'));
});


app.get('/raleigh-countertops',express.static(path.join(__dirname,'public','raleigh-countertops')),express.static(path.join(__dirname,'public','raleigh-countertops','css')),express.static(path.join(__dirname,'public','raleigh-countertops','images')),async(req,res)=>{
res.sendFile(path.join(__dirname , 'public' , 'raleigh-countertops','index.html'));
})
const validateLogin = async (req, res, next) => {
    try {
        if (req.session.user_log_id && req.session.user_log_id!='') {
            next();             
        } else {
            console.log(req.session.user_log_id);
            res.redirect('/admin');
        }
    } catch (error) {
        console.error('Error in validateLogin middleware:', error);
        res.status(500).send('Internal Server Error');
    }
};


const loadProducts = async(length) =>{
    lengths = length=='' ? 9999999999 : length;
    return new Promise((resolve,reject)=>{
        db.query('SELECT prod_id,prod_name,prod_primary_color , prod_slab_size1 , prod_slab_size2 ,prod_stone_cat , prod_finishes ,prod_images From products_data WHERE prod_images IS NOT NULL AND prod_status!=1 ORDER BY created_date DESC limit ?' , [lengths] , async(err,res)=>{
            if(err){
                reject(err);
            }else{
               resolve(res);
            }
        })
    })
}

const singleProdData = async(prodId)=>{
    return new Promise((resolve,reject)=>{
        db.query('SELECT * FROM products_data WHERE prod_status!=1 AND prod_images IS NOT NULL AND prod_id=?',[prodId] , async(err,res)=>{
            if(err){
                reject('failed');
            }else{
                if (res.length > 0) {
                    resolve(res[0]); // Resolve with the first row if data exists
                } else {
                    resolve('empty'); // Reject if no data is found
                }
            }
        })
    })
}
const singleProdDataProd = async(prodName)=>{
    return new Promise((resolve,reject)=>{
        db.query('SELECT * FROM products_data WHERE prod_status!=1 AND prod_images IS NOT NULL AND prod_name like ?',[`%${prodName}%`] , async(err,res)=>{
            if(err){
                reject('failed');
            }else{
                if (res.length > 0) {
                    resolve(res[0]); // Resolve with the first row if data exists
                } else {
                    resolve('empty'); // Reject if no data is found
                }
            }
        })
    })
}

const filters = async() =>{
    return new Promise((resolve,reject)=>{
        db.query("SELECT GROUP_CONCAT(DISTINCT CONCAT(prod_primary_color) SEPARATOR ',' ) as prod_primary_color , GROUP_CONCAT(DISTINCT CONCAT(prod_finishes) SEPARATOR ',' ) as prod_finishes, GROUP_CONCAT(DISTINCT CONCAT(prod_stone_cat) SEPARATOR ',' ) as prod_stone_cat , GROUP_CONCAT(DISTINCT CONCAT(prod_slab_size1, ',', prod_slab_size2) SEPARATOR ',' ) as sizes FROM `products_data` WHERE prod_images IS NOT NULL AND prod_status!=1 AND prod_images IS NOT NULL AND prod_status!=1 AND prod_slab_size1!=' ' AND prod_slab_size2!=' ' AND prod_slab_size1!='.' AND prod_slab_size2!='.'" , [] , async(err,res)=>{
            if(err){
                reject(err);
            }else{
               resolve(res[0]);
            }
        })
    })

}

const loginCheck = (email,password) =>{
    return new Promise((resolve,reject)=>{
        db.query('SELECT user_id,user_type,user_name,user_log_id FROM users WHERE user_email=? AND user_password=?' , [email,password] , async(err,res)=>{
            if(err){
                reject(err);
            }else{
                if(res.length==0){
                    resolve(1);
                }else{
                    resolve(res);
                }
            }
        })
    })
}

slugToText = (slug) => {
    // Replace dashes with spaces
    let text = slug.replace(/-/g, ' ');
    
    // Convert to title case
    text = text.toLowerCase().replace(/\b\w/g, function(char) {
        return char.toUpperCase();
    });

    return text;
}


app.get('/:fileName.html', (req, res) => {
    const fileName = req.params.fileName;
    res.redirect(`/${fileName}`);
  });

app.get('/product/:prod_name',async(req,res)=>{
    let loadProds=await loadProducts('');

    let prod_names = slugToText(req.params.prod_name).toLowerCase();
    let singleProdDatas=await singleProdDataProd(prod_names);
    
    if(singleProdDatas=='failed'){
        let loadProds=await loadProducts(18);
        let filter=await filters();
        res.render('products',{loadProds:loadProds,filter:filter})
    }else{
        res.render('product-view',{loadProds:loadProds,singleProdDatas:singleProdDatas});
    }    
})

app.get('/',async(req,res)=>{
    res.render('index');
})
app.get('/home',async(req,res)=>{
    res.render('index');
})
app.get('/about',async(req,res)=>{
    res.render('about');
})
app.get('/our-process',async(req,res)=>{
    res.render('our-process');
})
app.get('/locations',async(req,res)=>{
    res.render('locations');
})
app.get('/resources',async(req,res)=>{
    res.render('resources');
})
app.get('/contact',async(req,res)=>{
    res.render('contact');
})
app.get('/gallery-collection',async(req,res)=>{
    res.render('gallery-collection');
})
app.get('/quartzite',async(req,res)=>{
    res.render('quartzite');
})
app.get('/quartz',async(req,res)=>{
    res.render('quartz');
})
app.get('/granite',async(req,res)=>{
    res.render('granite');
})
app.get('/marble',async(req,res)=>{
    res.render('marble');
})
app.get('/onyx',async(req,res)=>{
    res.render('onyx');
})
app.get('/semi-precious-stones',async(req,res)=>{
    res.render('semi-precious-stones');
})
app.get('/porcelain',async(req,res)=>{
    res.render('porcelain');
})
app.get('/warranty',async(req,res)=>{
    res.render('warranty');
})
app.get('/care-maintenance',async(req,res)=>{
    res.render('care-maintenance');
})
app.get('/privacy-policy',async(req,res)=>{
    res.render('privacy-policy');
})
app.get('/terms-and-conditions',async(req,res)=>{
    res.render('terms-and-conditions');
})
app.get('/sitemap',async(req,res)=>{
    res.render('sitemap');
})
app.get('/404',async(req,res)=>{
    res.render('404');
})


app.get('/admin',async(req,res)=>{
    res.render('admin/index');
})
app.get('/products-home',[validateLogin],async(req,res)=>{
    res.render('admin/products-home');
})
app.get('/admin_products',[validateLogin],async(req,res)=>{

    let loadProds=await loadProducts('');
    let filter=await filters();

    res.render('admin/prods',{loadProds:loadProds,filter:filter})

})
app.get('/products_edit/:prodId',[validateLogin],async(req,res)=>{

    let singleProdDatas=await singleProdData(req.params.prodId);    
    if(singleProdDatas=='empty'){
        res.render('404');
    }else{
        res.render('admin/products_edit',{selectProdRes:singleProdDatas});
    }
    
})

app.post('/loginValidate',async(req,res)=>{
    let email = req.body.email;
    let password = req.body.password;

    let results = await loginCheck(email,password);
    if(results!=1){
        req.session.user_id=results[0].user_id;
        req.session.user_type=results[0].user_type;
        req.session.user_name=results[0].user_name;
        req.session.user_log_id=results[0].user_log_id;
        res.json({result:0});
    }else{
        res.json({result:1});
    }    

})

app.post('/productsInsert',async(req,res)=>{
    
    const form = new formidable.IncomingForm();
    form.parse(req, (err, fields, files) => {
        if (err) {
          console.error('Error parsing form data:', err);
          res.status(500).send('Internal Server Error');
          return;
        }
    
        const formData = fields;
    
        if (formData.formName[0] == 'productUpload') {
        //   const imgArr = formData.images.map(image => image.replace(/\s+/g, ''));
          const imgArr = formData.images;
          const postData = JSON.parse(formData.postData);
          const imgArrJson = JSON.stringify(imgArr);
    
          const { prodName, primColor, stoneCat, prodOrigin, prodSeries, prodSku, prodFinishs, priceRange,
            slabSize1, slabId1, slabSize2, slabJumbo, slabSuperJumbo, flooringResidential, flooringCommercial,
            counterResidential, counterCommercial, wallResidential, wallCommercial, exterior } = postData;
    
          const insertQuery = `INSERT INTO products_data (prod_name, prod_images, prod_primary_color, prod_origin, prod_sku, 
                               prod_series, prod_stone_cat, prod_finishes, prod_price_range, prod_slab_size1, prod_slab_id1, 
                               prod_slab_size2, prod_slab_jumbo, prod_slab_superjumbo, prod_floor_residential, 
                               prod_floor_commercial, prod_counter_residential, prod_counter_commercial, prod_wall_residential, 
                               prod_wall_commercial, exterior) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;
    
          db.query(insertQuery, [prodName, imgArrJson, primColor, prodOrigin, prodSku, prodSeries, stoneCat, prodFinishs, priceRange,
            slabSize1, slabId1, slabSize2, slabJumbo, slabSuperJumbo, flooringResidential, flooringCommercial,
            counterResidential, counterCommercial, wallResidential, wallCommercial, exterior], (err, result) => {
              if (err) {
                console.error(err);
                res.status(500).send(err.message);
              } else {
                res.status(200).send('0');
              }
            });
        } else {
          res.status(400).send('Invalid request');
        }
      });

})

app.post('/delete_prod',async(req,res)=>{

    let prodId = req.body.prod_id;
    const updateQuery = `UPDATE products_data SET prod_status = ? WHERE prod_id = ?`;

    db.query(updateQuery, [1,prodId], (err, result) => {
        if (err) {
            console.error(err);
            res.status(500).send(err.message);
        } else {
            res.status(200).send('1');
        }
    });

})
app.post('/productUpdate',async(req,res)=>{
    const form = new formidable.IncomingForm();
    form.parse(req, (err, fields, files) => {
        if (err) {
            console.error('Error parsing form data:', err);
            res.status(500).send('Internal Server Error');
            return;
        }
    
        const formData = fields;
    
        if (formData.formName[0] == 'productUpdate') {
            const imgArr = formData.images;
            // const imgArr = formData.images.map(image => image.replace(/\s+/g, ''));
            const postData = JSON.parse(formData.postData);
            const imgArrJson = JSON.stringify(imgArr);
    
            const { prodName, primColor, stoneCat, prodOrigin, prodSeries, prodSku, prodFinishs, priceRange,
                slabSize1, slabId1, slabSize2, slabJumbo, slabSuperJumbo, flooringResidential, flooringCommercial,
                counterResidential, counterCommercial, wallResidential, wallCommercial, exterior , prodId } = postData;
    
            const updateQuery = `UPDATE products_data SET 
                prod_name = ?, prod_images = ?, prod_primary_color = ?, prod_origin = ?, prod_sku = ?, 
                prod_series = ?, prod_stone_cat = ?, prod_finishes = ?, prod_price_range = ?, prod_slab_size1 = ?, 
                prod_slab_id1 = ?, prod_slab_size2 = ?, prod_slab_jumbo = ?, prod_slab_superjumbo = ?, 
                prod_floor_residential = ?, prod_floor_commercial = ?, prod_counter_residential = ?, 
                prod_counter_commercial = ?, prod_wall_residential = ?, prod_wall_commercial = ?, exterior = ? 
                WHERE prod_id = ?`;
    
                db.query(updateQuery, [prodName, imgArrJson, primColor, prodOrigin, prodSku, prodSeries, stoneCat, prodFinishs, priceRange,
                slabSize1, slabId1, slabSize2, slabJumbo, slabSuperJumbo, flooringResidential, flooringCommercial,
                counterResidential, counterCommercial, wallResidential, wallCommercial, exterior, prodId], (err, result) => {
                    if (err) {
                        console.error(err);
                        res.status(500).send(err.message);
                    } else {
                        res.status(200).send('0');
                    }
                });
        } else {
            res.status(400).send('Invalid request');
        }
})
})

app.post('/uploadImages', upload.array('images'), async (req, res) => {
    const imgArr = [];
    try {
        await Promise.all(req.files.map(async (file) => {
            const fileName = file.originalname;

            // Copy the original image to another folder
            const originalImagePath = file.path;
            const newImagePaths = path.join(__dirname, 'public', 'images', fileName);
            await fs.copyFile(originalImagePath, newImagePaths);
            // const fileName = file.originalname.replace(/\s+/g, '');

            const newWidth = 452;
            const newHeight = 250;
    
            // Load the original image
            const originalImage = await jimp.read(file.path);
    
            // Resize the original image to fit the new dimensions
            const newImage = await originalImage.resize(newWidth, newHeight);
    
            // Save the new image with a unique identifier and the original extension
            const newImagePath = path.join(__dirname,'public', 'images', 'resized', fileName);
            // const newImagePath = path.join(__dirname,'public', 'images', 'resized', fileName);
            await newImage.writeAsync(newImagePath);
    
            imgArr.push(fileName);
    
            // Delete the original image
            await fs.unlink(file.path);
        }));
    
        res.json(imgArr);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Failed to upload and resize images.' });
    }
    
});


const filterProd = async (loadMore, finishes, stoneCats, colors, sizes, sortVal) => {

    let query = `SELECT prod_id,prod_status, prod_stone_cat, prod_name, prod_primary_color, prod_slab_size1, prod_slab_size2, prod_finishes, prod_images FROM products_data WHERE prod_images IS NOT NULL AND prod_status != 1`;

    let condition = '';
    if (finishes || stoneCats || colors || sizes) {
        condition = ' AND ';
    }

    if (finishes) {
        const finishArr = finishes.split(',');
        let finishesCheck = '';

        for (let k = 0; k < finishArr.length; k++) {
            finishesCheck += (k === 0 ? '(' : ' OR ');
            finishesCheck += `prod_finishes LIKE '%${finishArr[k]}%'`;
        }

        finishesCheck += ')';
        query += condition + finishesCheck;
    }

    if (stoneCats) {
        query += `${condition} prod_stone_cat IN (${stoneCats})`;
        condition = ' OR ';
    }

    let colorsQuery = '';
    if (colors) {
        const colorArr = colors.split('|');

        for (let j = 0; j < colorArr.length; j++) {
            colorsQuery += (j === 0 ? `${condition} (` : ' OR ');
            colorsQuery += `prod_primary_color LIKE '%${colorArr[j]}%'`;
        }

        colorsQuery += ')';
        condition = ' OR ';
    }
    query += colorsQuery;

    if (sizes) {
        query += `${condition} (prod_slab_size1 IN ("${sizes}") OR prod_slab_size2 IN ("${sizes}"))`;
    }

    const order = (sortVal === '0') ? 'created_date DESC' : (sortVal === '1') ? 'prod_name ASC' : 'prod_stone_cat DESC';
    query += ` ORDER BY ${order} LIMIT ${loadMore}`;

    // console.log("Query:", query);

    return new Promise((resolve, reject) => {
        db.query(query, [], async (err, res) => {
            if (err) {
                reject('error');
            } else {
                console.log(res);
                resolve(res);
            }
        })
    })

}


const searchProds = async(searchString)=>{

    const query = `SELECT prod_id, prod_stone_cat, prod_name, prod_primary_color, prod_slab_size1, prod_slab_size2, prod_finishes, prod_images FROM products_data WHERE prod_images IS NOT NULL AND prod_status != 1 AND prod_name LIKE '%${searchString}%'`;

    return new Promise((resolve,reject)=>{
        db.query(query,[],async(err,res)=>{
            if(err){
                reject('error');
            }else{
                resolve(res);
            }
        })
    })

}

function createSlug(text) {
    let slug = text.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
    return slug;
}

app.post('/filter-products', async(req,res)=>{

    const loadMore = req.body.loadMore;
    const finishes = req.body.finishes;
    const stoneCats = req.body.stoneCats;
    const colors = req.body.colors;
    const sizes = req.body.sizes;
    const sortVal = req.body.sortVal;

    let filterProds=await filterProd(loadMore,finishes,stoneCats,colors,sizes,sortVal);

    if(filterProds=='error'){
        console.log('error occured');
    }else{
        let products = '';
        filterProds.forEach(row => {
          products += `<a href="product/${createSlug(row.prod_name)}" class="wrap" data-color="${row.prod_primary_color}" data-finish="${JSON.parse(row.prod_finishes).join(',')}" data-cat="${row.prod_stone_cat}" data-size1="${row.prod_slab_size1}" data-size2="${row.prod_slab_size2}">
            <img src="images/resized/${JSON.parse(row.prod_images)[0]}">
            <h5>${row.prod_name}</h5>
          </a>`;
        });
        res.send(products);
    }    

})

app.post('/search-products', async(req,res)=>{

    const searchString = req.body.string;
    let prodRes=await searchProds(searchString);

    if(prodRes=='error'){
        console.log('error occured');
    }else{
        let products = '';
        prodRes.forEach(row => {
          products += `<a href="product/${createSlug(row.prod_name)}" class="wrap" data-color="${row.prod_primary_color}" data-finish="${JSON.parse(row.prod_finishes).join(',')}" data-cat="${row.prod_stone_cat}" data-size1="${row.prod_slab_size1}" data-size2="${row.prod_slab_size2}">
            <img src="images/resized/${JSON.parse(row.prod_images)[0]}">
            <h5>${row.prod_name}</h5>
          </a>`;
        });
        res.send(products);
    }    

})

app.get('/products',async(req,res)=>{

    let loadProds=await loadProducts(18);
    let filter=await filters();

    res.render('products',{loadProds:loadProds,filter:filter})

})


app.use((req, res, next) => {
    res.status(404).render('404');
  });

server.listen(process.env.PORT,()=>{
    console.log('serve running with port 9595');
});