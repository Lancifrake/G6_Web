/*
 * Copyright (c) - All Rights Reserved.
 * 
 * See the LICENSE file for more information.
 */

/**
 * @file test.js
 * @description 
 * @author 
 * @copyright 
 */


let products = []

fetch('http://localhost:3000/products')
.then(response => response.json())
.then(data => {
    products = data;
 
const Category1 = products.filter (obj => obj.category = 0) ;  {
console.log(Category1);
    // remove datas default from HTML
 
    // add new datas based on category
    products.forEach(product => {
        if (product.category = 0) {
            let newProduct = document.createElement('div');
            newProduct.dataset.id = product.id;
            newProduct.classList.add('item');
            newProduct.innerHTML = 
            `<img src="${product.image}" alt="">
            <h2>${product.name}</h2>
            <div class="price">${product.price}XAF</div>
            <button class="addCart">
                <i class="bi bi-cart-fill"></i> Cart
            </button>`;
            listProductHTML.appendChild(newProduct);
        }
    });
}

const Category2= products.filter (obj => obj.category = 1) ;  
console.log(Category2);

const Category3  = products.filter (obj => obj.category = 2) ;  
console.log(Category3);
 


})

