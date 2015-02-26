/*
sticky sidebar from:
http://andrewhenderson.me/tutorial/jquery-sticky-sidebar/
*/

$(function(){ // document ready

  var stickyTop = $('.sticky').offset().top; // returns number

  $(window).scroll(function(){ // scroll event  

    var windowTop = $(window).scrollTop(); // returns number

    if (stickyTop < windowTop && windowTop < 5100) {
      $('.sticky').css({ position: 'fixed', top: 250 });
    }
    else {
      $('.sticky').css('position','static');
    }

  });

});

function food_item(name, ppserving, ssize, unit, calories, cholesterol, t_fat, sodium, carbs, d_fiber, protein, vit_A, vit_C, calcium, iron) {
    var food = {};
    food.name = name;
    food.ppserving = ppserving;
    food.serving_size = ssize;
    food.unit = unit;
    food.calories = calories;
    food.cholesterol = cholesterol;
    food.t_fat = t_fat;
    food.sodium = sodium;
    food.carbs = carbs;
    food.d_fiber = d_fiber;
    food.protein = protein;
    food.vit_A = vit_A;
    food.vit_C = vit_C;
    food.calcium = calcium;
    food.iron = iron;

    return food;
}

var food_list = [];

food_1 = food_item("Frozen Broccoli", 0.16, 10, "oz", 73.8, 0, 0.8, 68.2, 13.6, 8.5, 8, 5867.4, 160.2, 159, 2.3);
food_list.push(food_1);

food_2 = food_item("Carrots, Raw", 0.07, 0.5, "cup shredded", 23.7, 0, 0.1, 19.2, 5.6, 1.6, 0.6, 15471, 5.1, 14.9, 0.3);
food_list.push(food_2);

food_3 = food_item("Celery, Raw", 0.04, 1, "stalk", 23.7, 0, 0.1, 34.8, 1.5, 0.7, 0.3, 53.6, 2.8, 16, 0.2);
food_list.push(food_3);

food_4 = food_item("Frozen Corn", 0.18, 0.5, "cup", 72.2, 0, 0.6, 2.5, 17.1, 2, 2.5, 106.6, 5.2, 3.3, 0.3);
food_list.push(food_4);

food_5 = food_item("Lettuce, Iceberg, Raw", 0.02, 1, "leaf", 2.6, 0, 0, 1.8, 0.4, 0.3, 0.2, 66, 0.8, 3.8, 0.1);
food_list.push(food_5);

food_6 = food_item("Peppers, Sweet, Raw", 0.53, 1, "pepper", 20, 0, 0.1, 1.5, 4.8, 1.3, 0.7, 467.7, 66.1, 6.7, 0.3);
food_list.push(food_6);

food_7 = food_item("Potatoes, Baked", 0.06, 0.5, "cup", 171.5, 0, 0.2, 15.2, 39.9, 3.2, 3.7, 0, 15.6, 22.7, 4.3);
food_list.push(food_7);

food_8 = food_item("Tofu", 0.31, 0.25, "block", 88.2, 0, 5.5, 8.1, 2.2, 1.4, 9.4, 98.6, 0.1, 121.8, 6.2);
food_list.push(food_8);

food_9 = food_item("Roasted Chicken", 0.84, 1, "lb", 277.4, 129.9, 10.8, 125.6, 0, 0, 42.2, 77.4, 0, 21.9, 1.8);
food_list.push(food_9);

food_10 = food_item("Spaghetti with Sauce", 0.78, 1.25, "cup", 358.2, 0, 12.3, 1237.1, 58.3, 11.6, 8.2, 3055.2, 27.9, 80.2, 2.3);
food_list.push(food_10);

food_11 = food_item("Tomato, Red, Ripe, Raw", 0.27, 1, "tomato", 25.8, 0, 0.4, 11.1, 5.7, 1.4, 1, 766.3, 23.5, 6.2, 0.6);
food_list.push(food_11);

food_12 = food_item("Apple, Raw, with Skin", 0.24, 1, "fruit",81.4, 0, 0.5, 0, 21, 3.7, 0.3, 73.1, 7.9, 9.7, 0.2);
food_list.push(food_12);

food_13 = food_item("Banana", 0.15, 1, "fruit", 104.9, 0, 0.5, 1.1, 26.7, 2.7, 1.2, 92.3, 10.4, 6.8, 0.4);
food_list.push(food_13);

food_14 = food_item("Grapes", 0.32, 10, "fruits", 15.1, 0, 0.1, 0.5, 4.1, 0.2, 0.2, 24, 1, 3.4, 0.1);
food_list.push(food_14);

food_15 = food_item("Kiwifruit, Raw, Fresh", 0.49, 1, "med fruit", 46.4, 0, 0.3, 3.8, 11.3, 2.6, 0.8, 133, 74.5, 19.8, 0.3);
food_list.push(food_15);

food_16 = food_item("Oranges", 0.15, 1, "fruit", 61.6, 0, 0.2, 0, 15.4, 3.1, 1.2, 268.6, 69.7, 52.4, 0.1);
food_list.push(food_16);

food_17 = food_item("Bagels", 0.16, 1, "oz", 78, 0, 0.5, 151.4, 15.1, 0.6, 3, 0, 0, 21, 1);
food_list.push(food_17);

food_18 = food_item("Wheat Bread", 0.05, 1, "Sl", 65, 0, 1, 134.5, 12.4, 1.3, 2.2, 0, 0, 10.8, 0.7);
food_list.push(food_18);

food_19 = food_item("White Bread", 0.06, 1, "Sl", 65, 0, 1, 132.5, 11.8, 1.1, 2.3, 0, 0, 26.2, 0.8);
food_list.push(food_19);

food_20 = food_item("Oatmeal Cookies", 0.09, 1, "cookie", 81, 0, 3.3, 68.9, 12.4, 0.6, 1.1, 2.9, 0.1, 6.7, 0.5);
food_list.push(food_20);

food_21 = food_item("Apple Pie", 0.16, 67.2, 0, 3.1, 75.4, 9.6, 0.5, 0.5, 35.2, 0.9, 3.1, 0.1);
food_list.push(food_21);

food_22 = food_item("Chocolate Chip Cookies", 0.03, 1, "oz", 78.1, 5.1, 4.5, 57.8, 9.3, 0, 0.9, 101.8, 0, 6.2, 0.4);
food_list.push(food_22);

food_23 = food_item("Butter, Regular", 0.05, 1, "pat", 35.8, 10.9, 4.1, 41.3, 0, 0, 0, 152.9, 0, 1.2, 0);
food_list.push(food_23);

food_24 = food_item("Cheddar Cheese", 0.25, 1, "oz", 112.7, 29.4, 9.3, 173.7, 0.4, 0, 7, 296.5, 0, 202, 0.2);
food_list.push(food_24);

food_25 = food_item("3.3% Fat, Whole Milk", 0.16, 1, "cup", 149.9, 33.2, 8.1, 119.6, 11.4, 0, 8, 307.4, 2.3, 291.3, 0.1);
food_list.push(food_25);

food_26 = food_item("2% Lowfat Milk", 0.23, 1, "cup", 121.2, 18.3, 4.7, 121.8, 11.7, 0, 8.1, 500.2, 2.3, 296.7, 0.1);
food_list.push(food_26);

food_27 = food_item("Skim Milk", 0.13, 1, "cup", 85.5, 4.4, 0.4, 126.2, 11.9, 0, 8.4, 499.8, 2.4, 302.3, 0.1);
food_list.push(food_27);

food_28 = food_item("Poached Eggs", 0.08, 1, "large egg", 74.5, 211.5, 5, 140, 0.6, 0, 6.2, 316, 0, 24.5, 0.7);
food_list.push(food_28);

food_29 = food_item("Scrambled Eggs", 0.11, 1, "egg", 99.6, 211.2, 7.3, 168, 1.3, 0, 6.7, 409.2, 0.1, 42.6, 0.7);
food_list.push(food_29);

food_30 = food_item("Bologna Turkey", 0.15, 1, "oz", 56.4, 21.8, 4.3, 248.9, 0.3, 0, 3.9, 0, 0, 23.8, 0.4);
food_list.push(food_30);

food_31 = food_item("Frankfurter Beef", 0.27, 1, "frankfurter", 141.8, 27.4, 12.8, 461.7, 0.8, 0, 5.4, 0, 10.8, 9, 0.6);
food_list.push(food_31);

food_32 = food_item("Ham, Sliced, Extra lean", 0.33, 1, "Sl", 37.1, 13.3, 1.4, 405.1, 0.3, 0, 5.5, 0, 7.4, 2, 0.2);
food_list.push(food_32);

food_33 = food_item("Kielbasa, Pork", 0.15, 1, "Sl", 80.6, 17.4, 7.1, 279.8, 0.6, 0, 3.4, 0, 5.5, 11.4, 0.4);
food_list.push(food_33);

food_34 = food_item("Cap'n crunch", 0.31, 1, "Oz", 119.6, 0, 2.6, 213.3, 23, 0.5, 1.4, 40.6, 0, 4.8, 7.5);
food_list.push(food_34);

food_35 = food_item("Cheerios", 0.28, 1, "Oz", 111, 0, 1.8, 307.6, 19.6, 2, 4.3, 1252.2, 15.1, 48.6, 4.5);
food_list.push(food_35);

food_36 = food_item("Corn Flakes, Kellog's", 0.28, 1, "oz", 110.5, 0, 0.1, 290.5, 24.5, 0.7, 2.3, 1252.2, 15.1, 0.9, 1.8);
food_list.push(food_36);

food_37 = food_item("Raisin Bran, Kellog's", 0.34, 1.3, "oz", 115.1, 0, 0.7, 204.4, 27.9, 4, 4, 1250.2, 0, 12.9, 16.8);
food_list.push(food_37);

food_38 = food_item("Rice Krispies", 0.32, 1, "oz", 112.2, 0, 0.2, 340.8, 24.8, 0.4, 1.9, 1252.2, 15.1, 4, 1.8);
food_list.push(food_38);

food_39 = food_item("Special K", 0.38, 1, "oz", 110.8, 0, 0.1, 265.5, 21.3, 0.7, 5.6, 1252.2, 15.1, 8.2, 4.5);
food_list.push(food_39);

food_40 = food_item("Oatmeal", 0.82, 1, "cup", 145.1, 0, 2.3, 2.3, 25.3, 4, 6.1, 37.4, 0, 18.7, 1.6);
food_list.push(food_40);

food_41 = food_item("Malt-O-Meal, Chocolate", 0.52, 1, "cup", 607.2, 0, 1.5, 16.5, 128.2, 0, 17.3, 0, 0, 23.1, 47.2);
food_list.push(food_41);

food_42 = food_item("Pizza with Pepperoni", 0.44, 1, "slice", 181, 14.2, 7, 267, 19.9, 0, 10.1, 281.9, 1.6, 64.6, 0.9);
food_list.push(food_42);

food_43 = food_item("Taco", 0.59, 1, "small taco", 369.4, 56.4, 20.6, 802, 26.7, 0, 20.7, 855, 2.2, 220.6, 2.4);
food_list.push(food_43);

food_44 = food_item("Hamburger with Toppings", 0.83, 1, "burger", 275, 42.8, 10.2, 563.9, 32.7, 0, 13.6, 126.3, 2.6, 51.4, 2.5);
food_list.push(food_44);

food_45 = food_item("Hotdog, Plain", 0.31, 1, "hotdog", 242.1, 44.1, 14.5, 670.3, 18, 0, 10.4, 0, 0.1, 23.5, 2.3);
food_list.push(food_45);

food_46 = food_item("Couscous", 0.39, 0.5, "cup", 100.8, 0, 0.1, 4.5, 20.9, 1.3, 3.4, 0, 0, 7.2, 0.3);
food_list.push(food_46);

food_47 = food_item("White Rice", 0.08, 0.5, "cup", 102.7, 0, 0.2, 0.8, 22.3, 0.3, 2.1, 0, 0, 7.9, 0.9);
food_list.push(food_47);

food_48 = food_item("Macaroni Ckd", 0.17, 0.5, "cup", 98.7, 0, 0.5, 0.7, 19.8, 0.9, 3.3, 0, 0, 4.9, 1);
food_list.push(food_48);

food_49 = food_item("Peanut Butter", 0.07, 2, "tbsp", 188.5, 0, 16, 155.5, 6.9, 2.1, 7.7, 0, 0, 13.1, 0.6);
food_list.push(food_49);

food_50 = food_item("Pork", 0.81, 4, "oz", 710.8, 105.1, 72.2, 38.4, 0, 0, 13.8, 14.7, 0, 59.9, 0.4);
food_list.push(food_50);

food_51 = food_item("Sardines in Oil", 0.45, 2, "sardines", 49.9, 34.1, 2.7, 121.2, 0, 0, 5.9, 53.8, 0, 91.7, 0.7);
food_list.push(food_51);

food_52 = food_item("White Tuna in Water", 0.69, 3, "oz", 115.6, 35.7, 2.1, 333.2, 0, 0, 22.7, 68, 0, 3.4, 0.5);
food_list.push(food_52);

food_53 = food_item("Popcorn, Air-popped", 0.04, 1, "oz", 108.3, 0, 1.2, 1.1, 22.1, 4.3, 3.4, 55.6, 0, 2.8, 0.8);
food_list.push(food_53);

food_54 = food_item("Potato Chips, Bbq Flavor", 0.22, 1, "oz", 139.2, 0, 9.2, 212.6, 15, 1.2, 2.2, 61.5, 9.6, 14.2, 0.5);
food_list.push(food_54);

food_55 = food_item("Pretzels", 0.12, 1, "oz", 108, 0, 1, 486.2, 22.5, 0.9, 2.6, 0, 0, 10.2, 1.2);
food_list.push(food_55);

food_56 = food_item("Tortilla Chip", 0.19, 1, "oz", 142, 0, 7.4, 140.7, 17.8, 1.8, 2, 55.6, 0, 43.7, 0.4);
food_list.push(food_56);

food_57 = food_item("Chicken Noodle Soup", 0.39, 1, "cup", 150.1, 12.3, 4.6, 1862.2, 18.7, 1.5, 7.9, 1308.7, 0, 27.1, 1.5);
food_list.push(food_57);

food_58 = food_item("Split Pea and Hamsoup", 0.67, 1, "cup", 184.8, 7.2, 4, 964.8, 26.8, 4.1, 11.1, 4872, 7, 33.6, 2.1);
food_list.push(food_58);

food_59 = food_item("Vegetbeef Soup", 0.71, 1, "cup", 158.1, 10, 3.8, 1915.1, 20.4, 4, 11.2, 3785.1, 4.8, 32.6, 2.2);
food_list.push(food_59);

food_60 = food_item("New England Clam Chowder", 0.75, 1, "cup", 175.7, 10, 5, 1864.9, 21.8, 1.5, 10.9, 20.1, 4.8, 82.8, 2.8);
food_list.push(food_60);

food_61 = food_item("Tomato Soup", 0.39, 1, "cup", 170.7, 0, 3.8, 1744.4, 33.2, 1, 4.1, 1393, 133, 27.6, 3.5);
food_list.push(food_61);

food_62 = food_item("New England Clam Chowder with Milk", 0.99, 1, "cup", 163.7, 22.3, 6.6, 992, 16.6, 1.5, 9.5, 163.7, 3.5, 186, 1.5);
food_list.push(food_62);

food_63 = food_item("Corn Mushroom Soup, with Milk", 0.65, 1, "cup", 203.4, 19.8, 13.6, 1076.3, 15, 0.5, 6.1, 153.8, 2.2, 178.6, 0.6);
food_list.push(food_63);

food_64 = food_item("Beanbacon Soup, with Water", 0.67, 1, "cup", 172, 2.5, 5.9, 951.3, 22.8, 8.6, 7.9, 888, 1.5, 81, 2);
food_list.push(food_64)
