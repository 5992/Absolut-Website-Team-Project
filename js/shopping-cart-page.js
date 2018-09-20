/*this script depends on
- /ajax/shoppingcart.ajax.php
- /classes/shoppingcart.class.php
- /shoppingcart.php (loaded by the page)
*/

$(document).ready( () => {
  
  const spinner = `<img class="icon spinner" src="/images/graphics/icons/moc-spin-circle.png">`;
  const checkmark = `<img class="icon check" src="/images/graphics/icons/moc-check.png">`;
  //get the shopping list and render it
  const content = getCartContents();

  //shopping list listener
  //listen for click on shopping cart list and update or delete item(s)
  $('#shopping-list').click( (event) => {
    let target = event.target;
    //get the data attribute of the target
    let action = $(target).data('action');
    //if the data-action attribute is 'update'
    if( action == 'update' ){
      //remove checkmark if present
      $(target).find('.icon').remove();
      //if target is the add or subtract button
      if(! $(target).data('function')){
        $(target).append(spinner);
      }
      //get data from form
      let itemId = $(target).parents('.shopping-list-form').find('input[name="itemId"]').val();
      let pId = $(target).parents('.shopping-list-form').find('input[name="productId"]').val();
      let qty = $(target).parents('.shopping-list-form').find('input[name="quantity"]').val();
      let updateData = {productId : pId, quantity: qty, action: 'update' };
      console.log(updateData);
      // update the shopping cart
      getCartData( updateData, (response) => {
        console.log(response);
        if( response.success == true ){
          $('.spinner').remove();
          if(! $(target).data('function')){
            $(target).append(spinner);
            $(target).text('Updated')
            $(target).append(checkmark);
          }
          //update the totals locally
          updateCartTotal( getCartTotal());
        }
      });
    }
    //DELETE BUTTON
    if( action == 'delete' ){
      //get the product id
      let pId = $(target).parents('.shopping-list-form').find('input[name="productId"]').val();
      let deleteData = {productId : pId, action: 'delete' };
      getCartData( deleteData , (response) => {
        if(response.success == true ){
          //remove the item from list
          $(target).parents('.row').remove();
          //update the total
          updateCartTotal( getCartTotal());
          //update count in navbar by taking 1 off
          let count = parseInt( $('#cart-count').text() ) - 1;
          $('#cart-count').text(count);
        }
      });
    }
    //PLUS AND MINUS BUTTONS
    //listen for plus and minus buttons
    const btnFunction = $(target).data('function');
    const targetInput = $(target).parents('form').find('input[name="quantity"]');
    let quantity = $(targetInput).val();
    if( btnFunction == 'add' ){
      quantity++;
      $(targetInput).val( quantity );
      updateCartItem(target);
    } 
    if( btnFunction == 'subtract' ){
      quantity--;
      quantity = quantity < 1 ? 1 : quantity;
      $(targetInput).val( quantity );
      updateCartItem(target);
    }
  });
  
});

//called when user updates cart
//needs to be called after quantity changes
function updateCartItem( targetElement ){
  //remove checkmark if present
  $(targetElement).find('.check').remove();
  //if target is the add or subtract button
  if(! $(targetElement).data('function')){
    $(targetElement).append(spinner);
  }
  //get data from form
  let itemId = $(targetElement).parents('.shopping-list-form').find('input[name="itemId"]').val();
  let pId = $(targetElement).parents('.shopping-list-form').find('input[name="productId"]').val();
  let qty = $(targetElement).parents('.shopping-list-form').find('input[name="quantity"]').val();
  let updateData = {productId : pId, quantity: qty, action: 'update' };
  //update the shopping cart
  getCartData( updateData, (response) => {
    if( response.success == true ){
      $('.spinner').remove();
      // $(targetElement).text('Updated')
      // $(targetElement).append(checkmark);
      //update the totals locally
      updateCartTotal( getCartTotal());
    }
  });
}
function updateCartTotal(total){
  const total_element = $('#cart-total');
  console.log(total);
  $(total_element).val(total);
}
function getCartTotal(){
  //get all prices into an array
  const prices = Array.from ( $('.product-price') );
  //get all quantities into an array
  const qtys = Array.from( $('input[name="quantity"]') );
  let total = 0;
  //for each price, multiply the correspondin quantity and add to total
  prices.forEach( (elm, index) => {
    total += ( parseFloat( $(elm).text() * $( qtys[index] ).val() ) );
  });
  //fix the total to 2 decimals
  return total.toFixed(2);
}

function getCartData( cartData, callback ){
  $.ajax({
    url: '/ajax/shoppingcart.ajax.php',
    method: 'post',
    dataType: 'json',
    data: cartData
  })
  .done( (response) => {
    callback( response );
  });
}
function getCartContents(){
  const cartData = { action: 'list' };
  
  getCartData( cartData , (response) => {
    if( response.success == true ){
      console.log(response);
      response.items.forEach( (item) => {
        let itemId = item.item_id;
        let productId = item.product_id;
        let productName = item.name;
        let productPrice = item.price;
        let quantity = item.quantity;
        let image = item.image;
        let template = `<div class="row my-2">
          <div class="col-sm-2">
            <img class="img-fluid" src="/images/products/${image}">
          </div>
          
          <div class="col-6 col-sm-6 col-md-3">
            <h5 class="mt-0">${productName}</h5>
            <h4 class="product-price price">${productPrice}</h4>
            <p>product id: ${productId} </p>
          </div>
          <div class="col-12 col-sm-12 col-md-5 mt-sm-2">
          <form id="shopping-list-form-${itemId}" class="shopping-list-form">
            <div class="row mt-2 mt-sm-0">
              <div class="col-4 col-sm-6 col-md-3 col-lg-3 d-none d-sm-none d-lg-block">
                <label>Quantity</label>
              </div>
              <div class="col-6 col-sm-6 col-md-6 col-lg-5">
                <input type="hidden" name="productId" value="${productId}">
                <input type="hidden" name="itemId" value="${itemId}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="button" data-function="subtract">
                      &minus;
                    </button>
                  </div>
                  <input type="text" name="quantity" min="1" class="border-primary form-control text-center" value="${quantity}">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" data-function="add">
                      &plus;
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                <button type="button" class="btn btn-outline-info btn-block" data-product-id="${productId}" data-item-id="${itemId}" data-action="delete">
                  Delete
                </button>
              </div>
            </div>
          <form>
          </div>
          <hr>
        </div>`;
        $('#shopping-list').append(template);
      });
      
      
      //render the total price
      let totalPrice = response.total;
      let totalTemplate = `<div class="row mt-4">
        <div class="col">Total</div>
        <div class="col-8 col-sm-6 col-md-4">
          <div class="input-group w-auto">
            <div class="input-group-prepend">
              <span class="input-group-text">$</span>
            </div>
            <input name="cart-total" id="cart-total" class="form-control text-right" type="text" value="${totalPrice}" readonly>
            <div class="input-group-append">
              <!--add data to the checkout button-->
              <button class="btn btn-outline-success" id="checkout-button" >Checkout</button>
            </div>
          <div>
        </div>
      </div>`;
      //add the total price to shopping list items 
      $('#shopping-list').append(totalTemplate);
      return true;
    }
    else{
      return false;
    }
  });
}