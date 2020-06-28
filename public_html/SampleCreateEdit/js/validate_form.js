function validate() {

    var product_name = document.getElementById("product_name").value;
    var quantity = document.getElementById("quantity").value;
    var price = document.getElementById("price").value;
    var description = document.getElementById("description").value;
    var alpha = /^[A-Za-z]+$/; //regular expression for alphabet characters

    if (product_name == "" || quantity == "" || price == "" || description ==""){
        alert("Leave no fields empty");
        return false;
    }
    else if (!alpha.test(product_name) || !alpha.test(description)){
        alert("Only use words and letters for name and description");
        return false;
    }
    else if (alpha.test(quantity) || alpha.test(price)) {
        alert("Only use numbers for quantity and price");
        return false;
    }
    else return true;

}

