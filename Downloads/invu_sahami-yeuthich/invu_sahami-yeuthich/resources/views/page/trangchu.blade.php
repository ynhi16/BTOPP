@extends('layout')
@section('trangchu')
<div class="bg_header"></div>
<div class="body_product">
    <h1 class="wt-text-heading-01">Sản phẩm mới nhất</h1>
    <div class="btnGroupDrop">
        <!--  <div class="filter-state-tags">
            <form class="filter-price" onsubmit="return false">
                <div id="slider-range" style="height:14px;"></div>  
                <input type="text" id="amount" readonly style="border:0; font-weight:bold;">
                <input type="hidden" id="start-price" value="{{$minPrice[0]->donGia}}">
                <input type="hidden" id="end-price" value="{{$maxPrice[0]->donGia}}">
                <button type="submit" id="btn-filter-submit"> Lọc </button>
            </form>
            <div class="product-href-wrap">
                </div>
            </div> -->
        <input type="hidden" id="price-start-value" value="{{$minPrice[0]->donGia}}">
        <input type="hidden" id="price-end-value" value="{{$maxPrice[0]->donGia}}">
        <div class="btn-price-filter">
            <button id="btnGroupDrop1" type="button" class="dropdown-toggle btn_filter" data-bs-toggle="dropdown"
                aria-expanded="false">Giá (đ)</button>
            <form class="filter-price" onsubmit="return false">
                <div class="group-checkbox">
                    <input type="checkBox" id="checkbox">
                    <label style="font-size: 14px;" for="checkbox"> Custom </label>
                </div>
                <div class="group-price-input">
                    <input type="text" id="price-start" placeholder="Low">
                    <small> to </small>
                    <input type="text" id="price-end" placeholder="Hight">
                    <button type="submit" style="border: none; background: transparent; padding: 0;">
                        <i class="fas fa-chevron-right close"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="btn-price-sort">
            <button id="btnGroupDrop2" type="button" class="btn_filter">
                <span class="etsy-icon wt-icon--smaller-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        aria-labelledby="clgcoresort-screenreadertitle" role="img" focusable="false">
                        <path
                            d="M16 20.414l3.707-3.707a1 1 0 00-1.414-1.414L17 16.586V6a1 1 0 10-2 0v10.586l-1.293-1.293a1 1 0 10-1.414 1.414L16 20.414zM9 18V7.414l1.293 1.293a1 1 0 001.414-1.414L8 3.586 4.293 7.293a1 1 0 001.414 1.414L7 7.414V18a1 1 0 102 0z">
                        </path>
                    </svg>
                </span>
            </button>
            <ul>
                <li class="asc-price"> <i class="fas fa-arrow-up"></i> <span>Giá tăng dần</span> </li>
                <li class="desc-price"> <i class="fas fa-arrow-down"></i><span>Giá giảm dần</span></li>
            </ul>
        </div>
    </div>
    <div class="grid_product best-sell">
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-4">
            @for($i=0; $i<=20; $i++) <div class="col product">
                <div class="card">
                    <a href="{{URL::to('/chitietsanpham/'.$sanphambc[$i]->maSP)}}">
                        <img src="{{asset('public/frontend/img/'.$sanphambc[$i]->tenHA)}}" class="card-img-top"
                            alt="..." height="230px" width="98%">

                    </a>
                    <?php $maND = Session::get('nguoidung_id'); ?>
                    @if ($maND)


                    <ul class="featured__item__pic__hover">
                        <li><a href="{{URL::to('update-yeuthich/'.$sanphambc[$i]->maSP.'&tym-trang.png')}}"><img
                                    src="{{asset('public/frontend/img/tym-trang.png')}}" alt=""></a></li>
                    </ul>

                    @endif
                    <div class="card-body">
                        <div class="card-text">{{$sanphambc[$i]->tenSP}}</div>
                        <div class="d-flex align-items-start">
                            <div class="text-end price">{{$sanphambc[$i]->donGia}} VNĐ</div>
                        </div>
                    </div>
                </div>

        </div>
        @endfor
    </div>

</div>
</div>

<div class="footer_head">
    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1440 50"
        preserveAspectRatio="xMaxYMid" aria-hidden="true" focusable="false">
        <path
            d="M-90.6 63.2C-90.4 63.2-90.2 63.2-90 63.3L-88.5 68.6 -87.4 72.9 -71.9 129.9 -71.2 132.7 -61 170.5 -55.4 191.2 -28.6 290.2 -27.6 293.8 -23 310.9 -21.6 315.9 -18.5 327.3 -13 347.9 -5.8 374.3 -4.9 377.9 -2.9 385.3C-3.7 385.8-4 386.5-3.6 387.1L85.4 715.9C85.6 716.9 86.1 717.8 86.1 718.8 86.1 720.5 88.1 721.2 93.7 720.4 96.4 720 99.1 719.8 101.8 719.5 598.7 665.6 1095.6 611.7 1592.5 558 1602.2 556.9 1610.2 555.2 1618.4 553.2 1624.1 551.8 1627 550.2 1625.3 548.2 1623.4 546 1624.9 543.6 1627.2 541.2 1635 532.9 1634.2 525.1 1631.2 517.5 1630.1 514.8 1625.8 512.6 1625.7 509.8 1625.5 505.1 1620.4 501.2 1615.5 497.2 1609.9 492.7 1605.3 487.8 1611.1 481.9 1617 475.9 1629.7 470.1 1631 463.9L1617.3 413.3 1608.7 381.2 1590 312.1 1582.6 285 1562.2 209.5 1555.5 184.5C1549.2 186.9 1546.2 185.8 1543.1 184.9 1543.2 184.8 1543.4 184.7 1543.6 184.6 1545.4 181.3 1546.3 178.2 1541.5 175.6 1529.3 169 1522.5 161.6 1521.8 153 1521.3 146.3 1526 139 1518.9 132.9 1516.9 132.3 1514.6 131.9 1512.4 131.4 1510.8 127.2 1509.9 123 1508.9 118.9 1507.8 114.3 1504 111 1494.2 108.8 1494.7 108.3 1495.3 107.8 1496 107.2 1494.8 105.7 1493.9 104 1489.1 103.3 1483 102.4 1481.2 100.5 1480.3 98.3 1479.9 97.3 1480.5 96 1478.2 95.3 1466.6 91.7 1468.4 86.1 1467.9 80.8 1467.6 78.2 1466.2 75.7 1470.4 72.8 1475.9 69 1474.3 67.8 1463 67.4 1453 67 1443.3 66.3 1433.2 66 1414.1 65.5 1395.8 64.1 1375.8 64.6 1368.4 64.7 1361.5 65.1 1356.7 63.4 1353.8 62.3 1349.1 62.9 1345 63.6 1338.9 64.7 1334.8 64.4 1331.6 62.9 1328 61.3 1322.2 60.6 1315.5 60.4 1307.6 60.1 1300 59.4 1295.4 57.4 1291.2 55.6 1286.9 55.7 1280.1 57.4 1261.9 61.7 1242.1 64.6 1222.2 66.7 1196.9 69.3 1171.5 72 1147.4 69.8 1138.6 69.1 1131.6 68.3 1129 65.5 1124.1 60.2 1114.5 56.7 1095.2 56.6 1090.1 56.5 1084.9 56.7 1079.9 56.7 1065.8 56.6 1052.4 56.2 1040.4 54.3 1033.1 53.1 1028.5 51.2 1022.4 49.7 1014.3 47.9 1007.9 45.4 996.2 44.7 986.1 44 979.3 40.9 971.9 38.6 969.4 37.7 967 37.1 962.8 37.3 954.2 37.6 948.8 36.2 942.8 34.9 931.5 32.5 923.6 29 912.6 26.4 905.5 24.8 898 23.4 886.4 25.6 878.8 26.9 871.3 27.1 864.5 26.1 860.7 25.5 855.7 25.1 851.6 26.1 840.7 28.9 829.5 28.7 818.4 29.7 800.9 31.1 783.3 31.8 767.6 31.2 756.1 30.8 745.1 29.1 733.6 28.2 726.5 27.6 719.6 27 711.8 27.3 708.8 27.4 705.8 27.6 702.8 27.5 676.4 26.5 655.7 21.7 628.6 21.1 616.5 20.8 608.4 17.5 597.2 17.1 580.6 16.5 570.5 14.2 564.6 9.5 563 8.3 559.5 7.1 553.3 7.8 530.2 10.7 510.1 10.5 492.9 6.8 487.9 5.8 482.6 6.2 478.2 8.5 474.1 10.5 468 11.8 462.1 13.1 445.7 16.9 427.8 18 410.6 20.4 396.7 22.3 383.6 21.4 369.8 23.3 364.5 24 359.5 23.4 355.3 22.6 349 21.3 341.3 21.5 333.9 23.1 320 26 305.7 26.6 292 27.1 278.2 27.5 265 28.4 251.3 30.5 239.7 32.3 227.7 33.7 217.9 31.3 209.5 29.3 195.2 29.7 184.1 32.1 163.3 36.7 163.1 36.7 148.6 32.5 146.9 31.9 145.9 31.2 144.1 30.7 140.1 29.7 135.4 29.2 129.2 29.6 109.9 30.6 92.9 30.3 84.8 24.5 81.4 22.1 76.2 22.1 68.5 24.3 63.8 25.6 59.3 27 53.8 27.5 38.5 28.9 22.9 30.4 8.2 30.1 -10.7 29.6-30.4 30-49.8 30.8 -63.3 31.3-77.8 32.3-91.8 34.4 -97.2 35.2-98.7 36-98.2 37.6 -95.4 46.1-94.3 54.8-90.6 63.2Z"
            fill="#F8EBE6"></path>
        <path
            d="M1646.3 75.2C1646.1 75.2 1645.9 75.2 1645.7 75.3L1644.2 80.6 1643.1 84.9 1627.6 141.9 1626.9 144.7 1616.7 182.5 1611.1 203.2 1584.3 302.2 1583.3 305.8 1578.7 322.9 1577.3 327.9 1574.2 339.3 1568.7 359.9 1561.5 386.3 1560.6 389.9 1558.6 397.3C1559.4 397.8 1559.7 398.5 1559.3 399.1L1470.3 727.9C1470.1 728.9 1469.6 729.8 1469.6 730.8 1469.6 732.5 1467.6 733.2 1461.9 732.4 1459.3 732 1456.6 731.8 1453.9 731.5 957 677.6 460.1 623.7-36.9 570 -46.5 568.9-54.5 567.2-62.7 565.2 -68.4 563.8-71.3 562.2-69.6 560.2 -67.7 558-69.2 555.6-71.5 553.2 -79.3 544.9-78.5 537.1-75.5 529.5 -74.4 526.9-70.1 524.6-70 521.8 -69.8 517.1-64.7 513.2-59.8 509.2 -54.2 504.7-49.6 499.8-55.4 493.9 -61.3 487.9-74 482.1-75.3 475.9L-61.6 425.3 -53 393.2 -34.3 324.1 -26.9 297 -6.5 221.5 0.2 196.5C6.5 198.9 9.5 197.8 12.6 196.9 12.5 196.8 12.3 196.7 12.1 196.6 10.3 193.3 9.4 190.2 14.2 187.6 26.4 181 33.2 173.6 33.9 165 34.4 158.3 29.7 151 36.8 144.9 38.8 144.3 41 143.9 43.3 143.4 44.9 139.2 45.8 135 46.8 130.9 47.9 126.3 51.7 123 61.5 120.8 61 120.3 60.4 119.8 59.7 119.2 60.9 117.7 61.8 116 66.6 115.3 72.7 114.4 74.5 112.5 75.4 110.3 75.8 109.3 75.2 108 77.5 107.3 89.1 103.7 87.3 98.1 87.8 92.8 88 90.2 89.5 87.7 85.3 84.8 79.8 81 81.4 79.8 92.7 79.4 102.7 79.1 112.4 78.3 122.5 78 141.6 77.5 159.9 76.1 179.9 76.6 187.3 76.7 194.2 77.1 199 75.4 201.9 74.3 206.6 74.9 210.7 75.6 216.8 76.7 220.9 76.4 224.1 74.9 227.7 73.3 233.5 72.6 240.2 72.4 248.1 72.1 255.7 71.4 260.3 69.4 264.5 67.6 268.8 67.7 275.6 69.4 293.8 73.7 313.6 76.6 333.5 78.7 358.8 81.3 384.2 84 408.3 81.8 417.1 81.1 424.1 80.3 426.7 77.5 431.6 72.2 441.2 68.7 460.5 68.6 465.6 68.5 470.8 68.7 475.8 68.7 489.9 68.6 503.3 68.2 515.3 66.3 522.6 65.1 527.2 63.2 533.3 61.7 541.4 59.9 547.8 57.4 559.5 56.7 569.6 56 576.4 52.9 583.8 50.6 586.3 49.7 588.7 49.1 592.9 49.3 601.5 49.7 606.9 48.2 612.9 46.9 624.2 44.5 632.1 41 643 38.4 650.1 36.8 657.7 35.4 669.3 37.6 676.9 38.9 684.4 39.1 691.2 38.1 695 37.5 700 37.1 704.1 38.1 715 40.9 726.2 40.7 737.3 41.7 754.8 43.1 772.4 43.8 788 43.2 799.6 42.8 810.5 41.1 822 40.2 829.2 39.6 836.1 39 843.9 39.3 846.9 39.4 849.9 39.6 852.9 39.5 879.3 38.5 900 33.7 927.1 33.1 939.2 32.8 947.3 29.5 958.5 29.1 975.1 28.5 985.2 26.2 991.1 21.5 992.7 20.3 996.2 19.1 1002.4 19.8 1025.5 22.7 1045.6 22.5 1062.8 18.8 1067.8 17.8 1073.1 18.2 1077.5 20.5 1081.6 22.5 1087.6 23.8 1093.6 25.1 1110 28.9 1127.9 30 1145.1 32.4 1159 34.3 1172.1 33.4 1185.9 35.3 1191.2 36 1196.2 35.4 1200.4 34.6 1206.7 33.3 1214.4 33.5 1221.8 35.1 1235.7 38 1250 38.6 1263.7 39.1 1277.5 39.5 1290.7 40.4 1304.4 42.5 1316 44.3 1328 45.7 1337.8 43.3 1346.2 41.3 1360.5 41.7 1371.6 44.1 1392.4 48.7 1392.6 48.7 1407 44.5 1408.8 43.9 1409.8 43.2 1411.6 42.7 1415.6 41.7 1420.3 41.2 1426.5 41.6 1445.8 42.6 1462.8 42.3 1470.9 36.5 1474.3 34.1 1479.5 34.1 1487.2 36.3 1491.9 37.6 1496.4 39 1501.9 39.5 1517.2 40.9 1532.8 42.4 1547.5 42.1 1566.4 41.6 1586.1 42 1605.5 42.8 1619 43.3 1633.5 44.3 1647.5 46.4 1652.9 47.2 1654.4 48 1653.9 49.6 1651.1 58.1 1650 66.8 1646.3 75.2Z"
            fill="#F8EBE6"></path>
    </svg>
</div>
<div class="footer_middle">
    <div class="footer_middle_body">
        <h1 class="wt-text-heading-01">Sản phẩm yêu thích</h1>
        <div class="grid_product">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-6">
                @for($i=0; $i<=7; $i++) <div class="col product">
                    <div class="card favorite">
                        <a href="{{URL::to('/chitietsanpham/'.$sanphambc[$i]->maSP)}}">
                            <img src="{{asset('public/frontend/img/'.$sanphambc[$i]->tenHA)}}" class="card-img-top"
                                alt="..." height="180px" width="98%"></a>
                        <div class="card-body">
                            <div class="card-text">{{$sanphambc[$i]->tenSP}}</div>
                            <div class="d-flex align-items-start">
                                <div class="text-end price">{{$sanphambc[$i]->donGia}} VNĐ</div>
                            </div>
                        </div>
                    </div>
            </div>
            @endfor
        </div>
    </div>
</div>

</div>
<script src="{{asset('resources/js/app.js')}}"></script>
@endsection