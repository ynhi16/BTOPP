// config price filter bar
let startPrice = $("#price-start-value").val();
let endPrice = $("#price-end-value").val();

// start = Math.floor(start / 1000) * 1000;

const btnPriceFilter = document.querySelector("#btnGroupDrop1");
const btnPriceFilterGroup = document.querySelector(".btn-price-filter");

const btnPriceSort = document.querySelector("#btnGroupDrop2");
const btnPriceSortGroup = document.querySelector(".btn-price-sort");

document.addEventListener("click", function handleClickOutsideBox(event) {
    if (
        !btnPriceFilter.contains(event.target) &&
        !document.querySelector(".filter-price").contains(event.target)
    ) {
        btnPriceFilterGroup.classList.remove("open");
    }
    if (
        !btnPriceSort.contains(event.target) &&
        !document.querySelector(".btn-price-sort ul").contains(event.target)
    ) {
        btnPriceSortGroup.classList.remove("open");
    }
});
btnPriceFilter.onclick = () => {
    btnPriceFilterGroup.classList.toggle("open");
};

btnPriceSort.onclick = () => {
    btnPriceSortGroup.classList.toggle("open");
};

let start, end;
let sortState = null;
const formPrice = document.querySelector(".filter-price");
const startInput = formPrice.querySelector("#price-start");
const endInput = formPrice.querySelector("#price-end");

startInput.onfocus = () => {
    document.querySelector("#checkbox").checked = true;
};
endInput.onfocus = () => {
    document.querySelector("#checkbox").checked = true;
};
formPrice.addEventListener("submit", () => {
    start = startInput.value ? startInput.value : startPrice;
    end = endInput.value ? endInput.value : endPrice;
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
        method: "POST", // phương thức gửi dữ liệu.
        data: {
            start,
            end,
            sortState,
        },
        success: function (data) {
            //dữ liệu nhận về
            $("#search_ajax").fadeIn();
            if (data) $(".grid_product.best-sell .row").html(data);
            else
                $(".grid_product.best-sell .row").html(
                    "<h1 style='text-align: center; width: 40%; margin: 0 auto;'> Không có kết quả tìm kiếm phù hợp </h1>"
                );
            // filterPrice.remove();
            if (start === startPrice && end !== endPrice)
                btnPriceFilter.innerText = `Giá (đ): thấp hơn ${Number(
                    end
                ).toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND",
                })}`;
            else if (start !== startPrice && end === endPrice)
                btnPriceFilter.innerText = `Giá (đ): cao hơn ${Number(
                    start
                ).toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND",
                })}`;
            else if (start !== startPrice && end !== endPrice)
                btnPriceFilter.innerText = `Giá (đ): ${Number(
                    start
                ).toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND",
                })} - ${Number(end).toLocaleString("vi-VN", {
                    style: "currency",
                    currency: "VND",
                })}`;
            else btnPriceFilter.innerText = `Giá (đ)`;
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });
});
// startPrice = Math.floor(startPrice / 1000) * 1000;

// let start = startPrice;
// let end = endPrice;

// $("#slider-range").slider({
//     orientation: "horizontal",
//     min: start,
//     max: end,
//     range: true,
//     step: 1000,
//     values: [start, end],
//     slide: function (event, ui) {
//         $("#amount").val(
//             Number(ui.values[0]).toLocaleString("vi-VN", {
//                 style: "currency",
//                 currency: "VND",
//             }) +
//                 " - " +
//                 Number(ui.values[1]).toLocaleString("vi-VN", {
//                     style: "currency",
//                     currency: "VND",
//                 })
//         );
//         $("#start-price").val(ui.values[0]);
//         $("#end-price").val(ui.values[1]);
//     },
// });
// $("#amount").val(
//     Number($("#slider-range").slider("values", 0)).toLocaleString("vi-VN", {
//         style: "currency",
//         currency: "VND",
//     }) +
//         " - " +
//         Number($("#slider-range").slider("values", 1)).toLocaleString("vi-VN", {
//             style: "currency",
//             currency: "VND",
//         })
// );
// //handle submit filter
// const formPrice = document.querySelector(".filter-price");

// let filterSlug = document.querySelector(".product-href-wrap");
// const filterItemSlug = document.createElement("div");
// const filterPrice = document.createElement("div");
// const filterSort = document.createElement("div");

// let sortState = null;

// formPrice.addEventListener("submit", () => {
//     start = formPrice.querySelector("#start-price").value;
//     end = formPrice.querySelector("#end-price").value;

//     filterPrice.className = `filter-slug price`;
//     filterPrice.innerHTML = `${Number(start).toLocaleString("vi-VN", {
//         style: "currency",
//         currency: "VND",
//     })} - ${Number(end).toLocaleString("vi-VN", {
//         style: "currency",
//         currency: "VND",
//     })}<i class="fas fa-times close"></i>`;

//     filterSlug.append(filterPrice);
//     filterPrice.querySelector("i").onclick = () => {
//         start = startPrice;
//         end = endPrice;
//         $("#slider-range").slider({
//             orientation: "horizontal",
//             min: start,
//             max: end,
//             range: true,
//             step: 1000,
//             values: [start, end],
//             slide: function (event, ui) {
//                 $("#amount").val(
//                     Number(ui.values[0]).toLocaleString("vi-VN", {
//                         style: "currency",
//                         currency: "VND",
//                     }) +
//                         " - " +
//                         Number(ui.values[1]).toLocaleString("vi-VN", {
//                             style: "currency",
//                             currency: "VND",
//                         })
//                 );
//                 $("#start-price").val(ui.values[0]);
//                 $("#end-price").val(ui.values[1]);
//             },
//         });
//         $("#amount").val(
//             Number($("#slider-range").slider("values", 0)).toLocaleString(
//                 "vi-VN",
//                 {
//                     style: "currency",
//                     currency: "VND",
//                 }
//             ) +
//                 " - " +
//                 Number($("#slider-range").slider("values", 1)).toLocaleString(
//                     "vi-VN",
//                     {
//                         style: "currency",
//                         currency: "VND",
//                     }
//                 )
//         );
//         $.ajax({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//             url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
//             method: "POST", // phương thức gửi dữ liệu.
//             data: {
//                 start,
//                 end,
//                 sortState,
//             },
//             success: function (data) {
//                 //dữ liệu nhận về
//                 $("#search_ajax").fadeIn();
//                 $(".grid_product .row").html(data);
//                 filterPrice.remove();
//             },
//             error: function (xhr) {
//                 console.log(xhr.responseText);
//             },
//         });
//     };

//     /*  $.post("./ajax/filter", { start, end }, (data) => {
//         console.log(data);
//         document.querySelector(".grid_product").innerHTML = data;
//     }); */

//     $.ajax({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//         url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
//         method: "POST", // phương thức gửi dữ liệu.
//         data: {
//             start,
//             end,
//             sortState,
//         },
//         success: function (data) {
//             //dữ liệu nhận về
//             $("#search_ajax").fadeIn();
//             $(".grid_product .row").html(data);
//             console.log(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
//         },
//         error: function (xhr) {
//             console.log(xhr.responseText);
//         },
//     });
// });

const btnSortPrices = document.querySelectorAll(".btn-price-sort ul li");

const checkedSortState = document.createElement("i");

checkedSortState.className = "fas fa-check";
btnSortPrices.forEach((btnSortState) => {
    btnSortState.onclick = () => {
        let btnSortPriceActive = document.querySelector(
            ".btn-price-sort ul li.active"
        );
        if (btnSortPriceActive !== btnSortState)
            btnSortPriceActive?.classList.remove("active");
        btnSortState.classList.toggle("active");
        if (btnSortState.className === "asc-price active") {
            sortState = "asc";
            btnSortState.append(checkedSortState);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                method: "POST", // phương thức gửi dữ liệu.
                data: {
                    start,
                    end,
                    sortState,
                },
                success: function (data) {
                    //dữ liệu nhận về
                    $("#search_ajax").fadeIn();
                    if (data) $(".grid_product.best-sell .row").html(data);
                    else
                        $(".grid_product.best-sell .row").html(
                            "<h1 style='text-align: center; width: 40%; margin: 0 auto;'> Không có kết quả tìm kiếm phù hợp </h1>"
                        );
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
        // remove active
        if (btnSortState.className === "asc-price") {
            sortState = "";
            checkedSortState.remove();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                method: "POST", // phương thức gửi dữ liệu.
                data: {
                    start,
                    end,
                    sortState,
                },
                success: function (data) {
                    //dữ liệu nhận về
                    $("#search_ajax").fadeIn();
                    if (data) $(".grid_product.best-sell .row").html(data);
                    else
                        $(".grid_product.best-sell .row").html(
                            "<h1 style='text-align: center; width: 40%; margin: 0 auto;'> Không có kết quả tìm kiếm phù hợp </h1>"
                        );
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
        //desc price
        if (btnSortState.className === "desc-price active") {
            sortState = "desc";
            btnSortState.append(checkedSortState);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                method: "POST", // phương thức gửi dữ liệu.
                data: {
                    start,
                    end,
                    sortState,
                },
                success: function (data) {
                    //dữ liệu nhận về
                    $("#search_ajax").fadeIn();
                    if (data) $(".grid_product.best-sell .row").html(data);
                    else
                        $(".grid_product.best-sell .row").html(
                            "<h1 style='text-align: center; width: 40%; margin: 0 auto;'> Không có kết quả tìm kiếm phù hợp </h1>"
                        );
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
        if (btnSortState.className === "desc-price") {
            sortState = "";
            checkedSortState.remove();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                method: "POST", // phương thức gửi dữ liệu.
                data: {
                    start,
                    end,
                    sortState,
                },
                success: function (data) {
                    //dữ liệu nhận về
                    $("#search_ajax").fadeIn();
                    if (data) $(".grid_product.best-sell .row").html(data);
                    else
                        $(".grid_product.best-sell .row").html(
                            "<h1 style='text-align: center; width: 40%; margin: 0 auto;'> Không có kết quả tìm kiếm phù hợp </h1>"
                        );
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        }
    };
});
/* btnSortPrice.onclick = () => {
    if (sortState === null) {
        sortState = "asc";
        filterSort.className = `filter-slug asc`;
        filterSort.innerHTML = `<i class="fas fa-coins" style='margin-right: .3rem'></i> Tăng dần <i class="fas fa-times close"></i>`;
        filterSlug.append(filterSort);
    } else if (sortState === "desc") {
        sortState = "asc";
        filterSort.className = `filter-slug asc`;
        filterSort.innerHTML = `<i class="fas fa-coins" style='margin-right: .3rem'></i> Tăng dần <i class="fas fa-times close"></i>`;
        filterSlug.append(filterSort);
    } else {
        sortState = "desc";
        filterSort.className = `filter-slug desc`;
        filterSort.innerHTML = `<i class="fas fa-coins" style='margin-right: .3rem'></i> Giảm dần <i class="fas fa-times close"></i>`;
        filterSlug.append(filterSort);
    }
    console.log(sortState);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
        method: "POST", // phương thức gửi dữ liệu.
        data: {
            start,
            end,
            sortState,
        },
        success: function (data) {
            //dữ liệu nhận về
            $("#search_ajax").fadeIn();
            $(".grid_product .row").html(data);
            console.log(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });

    filterSort.querySelector("i.close").onclick = () => {
        sortState = null;
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "./ajax/filter", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
            method: "POST", // phương thức gửi dữ liệu.
            data: {
                start,
                end,
                sortState,
            },
            success: function (data) {
                //dữ liệu nhận về
                $("#search_ajax").fadeIn();
                $(".grid_product .row").html(data);
                filterSort.remove();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    };
};
 */
