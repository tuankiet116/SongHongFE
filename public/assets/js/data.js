var colordata = [
    {
        "color":"red"
    },
    {
        "color":"blue"
    },
    {
        "color":"white"
    },
    {
        "color":"purple"
    },
    {
        "color":"green"
    }
];
var productRelation = [
    {
        "catogory":"Chăn gối Urban",
        "image":"assets/images/product/product1.jpg",
        "link":"#1",
        "name":"Đệm back Essential",
        "cost":"2.427.000đ",
        "sale":"2.055.000đ"
    },
    {
        "catogory":"Chăn gối Urban",
        "image":"assets/images/product/product2.jpg",
        "link":"#2",
        "name":"Đệm back Essential",
        "cost":"2.427.000đ",
        "sale":"2.427.000đ"
    },
    {
        "catogory":"Chăn gối Urban",
        "image":"assets/images/product/product3.jpg",
        "link":"#3",
        "name":"Đệm back Essential",
        "cost":"2.427.000đ",
        "sale":"2.427.000đ"
    },
    {
        "catogory":"Chăn gối Urban",
        "image":"assets/images/product/product4.jpg",
        "link":"#4",
        "name":"Đệm back Essential",
        "cost":"2.427.000đ",
        "sale":"2.427.000đ"
    },
    {
        "catogory":"Chăn gối Urban",
        "image":"assets/images/product/product5.jpg",
        "link":"#5",
        "name":"Đệm back Essential",
        "cost":"2.427.000đ",
        "sale":"2.427.000đ"
    }
];
var color_select =""
$(document).ready(function () {
    for(var i=0; i<=colordata.length; i++) {
      if(colordata[i]?.color=="red"){
          $(".wrap-color").append(`
            <div class="sh-color sh-color-red"></div>
        `)
      }
      else if(colordata[i]?.color=="blue"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-blue"></div>
      `)
      }
      else if(colordata[i]?.color=="yellow"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-yellow"></div>
      `)
      }
      else if(colordata[i]?.color=="black"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-black"></div>
      `)
      }
      else if(colordata[i]?.color=="white"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-white"></div>
      `)
      }
      else if(colordata[i]?.color=="purple"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-purple"></div>
      `)
      }
      else if(colordata[i]?.color=="gray"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-gray"></div>
      `)
      }
      else if(colordata[i]?.color=="green"){
        $(".wrap-color").append(`
            <div class="sh-color sh-color-green"></div>
      `)
      }
    }
    $('.sh-color').on('click', function(){
        var item=$('.wrap-color').find('.select-color')
        for(var i=0 ; i< item.length;i++){
            item[i].classList.remove("select-color");
        }
        this.classList.add("select-color");
        color_select =this.classList[1]
        console.log("object",color_select)
    });

    for(var i=0; i<productRelation.length; i++) {
        $(".related-products-suggest").append(`
            <a href="#" class="row">
                <img  class="col-6 col-lg-6 " src="${productRelation[i].image}" alt="al" >
                <div class="col-6 col-lg-6 related-products-text" >
                    <p class="related-products-text-1">${productRelation[i].catogory}</p>
                    <p class="related-products-text-2">${productRelation[i].name}</p>
                    <p class="related-products-text-3">${productRelation[i].cost}</p>
                    <p class="related-products-text-4">${productRelation[i].sale}</p>
                </div>
            </a>
        `)

    }


});



