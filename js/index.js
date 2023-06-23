var nameInput =document.getElementById("productName")
var priceInput =document.getElementById("productPrice")
var categoryInput =document.getElementById("productCategory")
var descriptionInput =document.getElementById("productDescription")
var productList =[];
function addProduct(){
    var product ={
        name: nameInput.value,
        price: priceInput.value,  
       category: categoryInput.value,
       desc: descriptionInput.value
    }
    productList.push(product)
    displayData()
}
