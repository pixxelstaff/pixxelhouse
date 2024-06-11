<?php
session_start();
if(!isset($_SESSION['finance_manager_login'])){
  header("location:index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finance Dashboard</title>
  <?php include('include/links.php'); ?>
</head>

<body>

  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include('include/sidebar.php'); ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <?php include('include/navbar.php'); ?>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->

        <div class="row justify-content-center gap-4 my-4 flex-column align-items-center">
          <div class="col-12 text-center">
            <h2 class="sel-std">Generate Reports</h2>
          </div>
          <div class="custom-card col-lg-4 col-md-6 col-sm-12">
            <div class="info">
              <div class="report-name"><span>Batches Report</span></div>
              <div class="title">Generate A to Z report about the current Batches</div>
              <a href="batches-report.php" class="btn">Generate</a>
            </div>
            <div class="image">
              <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="30.000000pt" height="30.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                  <path d="M2420 5114 c-102 -20 -131 -52 -195 -212 l-48 -121 -66 -22 c-36 -12
                   -107 -41 -157 -64 l-90 -42 -115 49 c-204 86 -225 82 -384 -75 -62 -62 -121
                   -128 -131 -147 -30 -60 -23 -112 36 -248 l53 -124 -33 -66 c-19 -37 -48 -107
                   -65 -156 l-32 -89 -124 -49 c-132 -53 -160 -72 -189 -128 -24 -46 -35 -208
                   -22 -318 15 -129 41 -156 207 -222 44 -17 83 -35 87 -39 4 -3 -225 -101 -510
                   -216 -487 -198 -520 -213 -563 -256 -58 -56 -84 -128 -76 -204 11 -110 74
                   -181 205 -234 45 -18 82 -36 82 -40 0 -4 -37 -23 -82 -41 -146 -61 -202 -132
                   -203 -260 0 -64 4 -82 27 -122 39 -65 86 -101 184 -139 47 -17 81 -35 77 -39
                   -4 -4 -45 -22 -90 -40 -129 -52 -188 -122 -200 -235 -10 -96 38 -192 120 -239
                   23 -13 258 -112 522 -219 264 -107 788 -320 1165 -473 680 -277 685 -279 755
                   -278 68 1 97 12 1239 478 644 262 1185 486 1203 497 72 44 122 157 109 245
                   -15 109 -73 173 -208 229 -84 35 -90 39 -68 48 122 50 189 87 218 123 87 105
                   79 257 -20 351 -30 29 -78 55 -183 98 l-40 16 94 39 c152 63 206 130 206 260
                   0 58 -5 84 -22 116 -45 85 -69 97 -618 320 -283 115 -511 212 -507 215 4 4 43
                   22 87 39 166 66 192 93 207 222 12 101 2 272 -18 314 -26 54 -65 81 -193 132
                   l-124 49 -27 79 c-15 43 -44 113 -64 155 l-37 76 52 124 c58 137 65 189 35
                   249 -10 19 -69 85 -130 147 -159 157 -182 162 -385 74 l-113 -49 -82 38 c-44
                   21 -115 50 -157 65 l-76 27 -48 119 c-78 197 -98 211 -310 215 -77 1 -151 0
                   -165 -2z m256 -170 c16 -4 34 -39 79 -150 31 -79 64 -148 74 -153 9 -5 66 -25
                   126 -45 61 -21 147 -57 192 -82 46 -24 91 -44 100 -44 10 0 81 27 157 60 l139
                   59 26 -18 c44 -32 161 -158 161 -174 0 -9 -25 -73 -55 -143 -30 -70 -55 -138
                   -55 -151 0 -12 22 -67 49 -120 27 -54 63 -142 81 -196 18 -54 41 -106 51 -115
                   10 -9 78 -41 152 -70 l134 -53 6 -77 c2 -42 2 -104 -2 -137 l-6 -59 -135 -54
                   c-74 -30 -143 -60 -152 -69 -9 -8 -31 -60 -49 -115 -17 -55 -54 -143 -80 -196
                   -27 -52 -49 -105 -49 -118 0 -13 25 -80 55 -150 30 -70 55 -135 55 -143 0 -16
                   -168 -191 -183 -191 -5 0 -74 27 -154 61 l-145 60 -126 -60 c-70 -33 -161 -70
                   -202 -82 -41 -12 -84 -30 -94 -40 -11 -10 -44 -80 -75 -156 l-56 -138 -135 0
                   -135 0 -56 138 c-31 76 -64 146 -75 156 -10 10 -53 28 -94 41 -41 12 -132 49
                   -202 82 l-127 59 -146 -60 c-80 -34 -149 -61 -153 -61 -14 0 -182 176 -182
                   191 0 8 25 73 55 143 30 70 55 137 55 150 0 13 -23 67 -50 122 -28 54 -64 142
                   -81 195 -16 53 -38 104 -47 112 -9 8 -78 39 -152 69 l-135 54 -7 55 c-5 29 -5
                   91 -2 136 l6 82 135 53 c73 29 142 61 152 70 11 9 33 60 50 112 16 52 53 140
                   81 195 27 55 50 111 50 124 0 13 -25 81 -55 151 -30 70 -55 134 -55 143 0 16
                   117 142 161 174 l26 18 139 -59 c76 -33 146 -60 155 -60 9 0 60 23 114 50 54
                   28 141 64 193 81 52 16 103 34 112 39 10 6 43 72 76 154 35 89 63 147 73 149
                   24 7 213 7 237 1z m-1393 -2146 l37 -83 -51 -120 c-82 -191 -75 -225 80 -380
                   170 -169 198 -176 386 -95 64 27 123 50 130 50 7 0 55 -20 106 -44 52 -24 119
                   -52 149 -61 l56 -17 49 -124 c52 -133 85 -178 147 -200 20 -8 93 -12 188 -12
                   95 0 168 4 188 12 62 22 95 67 147 199 l49 123 80 28 c45 15 113 43 153 62 39
                   19 76 34 81 34 6 0 63 -22 127 -50 188 -81 216 -74 386 95 155 156 163 189 80
                   379 l-52 120 38 83 c20 46 40 83 44 83 4 0 236 -93 516 -206 352 -143 515
                   -213 531 -230 28 -32 28 -76 0 -108 -17 -18 -238 -112 -798 -340 -426 -173
                   -947 -384 -1158 -470 -211 -86 -396 -156 -411 -156 -16 0 -201 70 -412 156
                   -211 86 -733 297 -1159 470 -556 226 -781 322 -797 340 -29 32 -29 76 0 107
                   15 17 174 86 497 217 261 106 489 198 505 205 17 8 35 14 40 14 6 1 28 -36 48
                   -81z m220 -1194 c534 -217 991 -399 1015 -403 23 -5 61 -5 85 0 23 4 420 161
                   882 349 462 188 900 366 973 395 l133 54 161 -67 c182 -75 205 -95 194 -156
                   -4 -21 -16 -42 -30 -51 -12 -8 -292 -125 -622 -259 -329 -134 -849 -345 -1156
                   -470 -306 -124 -566 -226 -577 -226 -12 0 -322 122 -689 271 -367 149 -887
                   361 -1157 470 -269 110 -499 206 -512 214 -13 9 -25 30 -29 51 -11 61 13 81
                   192 155 87 37 160 67 162 68 1 0 440 -177 975 -395z m17 -605 l965 -394 75 0
                   75 0 977 398 976 398 156 -63 c86 -35 165 -72 176 -81 49 -42 32 -114 -33
                   -145 -23 -11 -305 -126 -627 -257 -322 -131 -832 -338 -1134 -461 -303 -123
                   -557 -224 -565 -224 -14 0 -2235 899 -2328 942 -65 30 -82 103 -34 145 26 22
                   323 143 341 139 8 -2 449 -180 980 -397z" />
                  <path d="M2359 4504 c-103 -18 -255 -74 -345 -125 -558 -319 -732 -1044 -379
                   -1574 210 -315 548 -497 925 -498 721 -1 1248 674 1074 1375 -106 425 -446
                   742 -883 823 -101 18 -288 18 -392 -1z m436 -183 c378 -100 648 -413 697 -807
                   21 -170 -9 -339 -91 -509 -126 -264 -364 -450 -653 -509 -97 -20 -284 -21
                   -375 -1 -398 84 -683 391 -743 800 -32 211 36 484 164 660 144 199 371 341
                   613 385 83 15 299 5 388 -19z" />
                  <path d="M2412 3990 c-144 -38 -270 -129 -352 -253 -44 -67 -90 -197 -90 -252
                   l0 -34 -37 25 c-65 44 -137 11 -137 -61 0 -32 11 -47 109 -145 147 -147 142
                   -147 287 -2 97 97 108 112 108 144 0 28 -7 42 -32 63 -35 30 -76 29 -111 -3
                   -19 -17 -20 -16 -13 23 4 22 22 72 42 112 59 122 172 204 311 225 110 16 112
                   17 129 44 25 37 20 85 -11 112 -33 28 -100 29 -203 2z" />
                  <path d="M3025 3651 c-16 -10 -69 -59 -117 -108 -78 -80 -88 -94 -88 -127 0
                   -73 76 -110 134 -65 31 25 33 16 10 -62 -27 -90 -88 -173 -169 -229 -52 -36
                   -152 -70 -205 -70 -46 0 -94 -21 -104 -45 -14 -37 -6 -82 19 -105 23 -21 30
                   -22 107 -17 145 10 268 68 374 176 87 89 148 212 161 323 3 26 8 48 10 48 3 0
                   16 -9 30 -20 56 -44 137 -6 137 65 0 34 -9 46 -110 146 -119 117 -134 124
                   -189 90z" />
                </g>
              </svg>
            </div>
          </div>
          <div class="custom-card col-lg-4 col-md-6 col-sm-12">
            <div class="info">
              <div class="report-name"><span>Institute Report</span></div>
              <div class="title">Information about the current performance of institute.</div>
              <a href="institute.php" class="btn">Generate</a>
            </div>
            <div class="image">
              <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="30.000000pt" height="30.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">

                <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                  <path d="M2505 5015 l-25 -24 0 -480 0 -481 -629 -2 -629 -3 -26 -24 -26 -24
                 0 -514 0 -513 -384 0 -385 0 -28 -24 -28 -24 -3 -1331 -2 -1331 -86 0 c-77 0
                 -87 -2 -109 -25 -33 -32 -33 -78 0 -110 l24 -25 2391 0 2391 0 24 25 c33 32
                 33 78 0 110 -22 23 -32 25 -109 25 l-86 0 -2 1331 -3 1331 -28 24 -28 24 -385
                 0 -384 0 0 513 0 514 -26 24 -26 24 -629 3 -629 2 0 150 0 150 350 0 351 0 26
                 26 c36 36 28 66 -56 208 l-70 119 27 46 c14 25 48 82 74 126 54 91 59 125 23
                 160 l-24 25 -406 0 -406 0 -24 -25z m644 -171 c-50 -81 -79 -140 -79 -162 0
                 -13 22 -62 49 -108 l50 -84 -265 0 -264 0 0 195 0 195 266 0 266 0 -23 -36z
                 m641 -1434 l0 -460 -1230 0 -1230 0 0 460 0 460 1230 0 1230 0 0 -460z m-1680
                 -1033 c0 -405 0 -414 20 -432 29 -26 85 -25 113 3 22 22 22 24 25 432 l3 410
                 104 0 105 0 0 -494 0 -495 23 -27 c33 -37 81 -37 114 0 l23 27 0 495 0 494
                 105 0 104 0 3 -411 3 -411 29 -25 c35 -29 80 -26 109 8 16 19 17 55 17 430 l0
                 409 805 0 805 0 0 -1275 0 -1275 -745 0 -745 0 -2 561 -3 561 -28 24 -28 24
                 -509 0 -509 0 -28 -24 -28 -24 -3 -561 -2 -561 -745 0 -745 0 0 1275 0 1275
                 805 0 805 0 0 -413z m370 -1632 l0 -505 -165 0 -165 0 0 505 0 505 165 0 165
                 0 0 -505z m490 0 l0 -505 -165 0 -165 0 0 505 0 505 165 0 165 0 0 -505z" />
                                   <path d="M1525 3708 c-43 -25 -44 -32 -45 -301 l0 -258 25 -24 24 -25 261 0
                 261 0 24 25 25 24 0 256 0 257 -29 29 -29 29 -249 0 c-168 -1 -254 -4 -268
                 -12z m415 -298 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z" />
                                   <path d="M2294 3708 c-40 -19 -44 -48 -44 -309 l0 -250 25 -24 24 -25 261 0
                 261 0 24 25 25 24 0 250 c0 265 -4 290 -47 310 -31 14 -499 14 -529 -1z m416
                 -298 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z" />
                                   <path d="M3049 3691 l-29 -29 0 -257 0 -256 25 -24 24 -25 261 0 261 0 24 25
                 25 24 0 258 c-1 187 -4 262 -13 274 -27 36 -52 39 -302 39 l-247 0 -29 -29z
                 m431 -281 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z" />
                                   <path d="M731 2484 c-21 -27 -21 -31 -21 -969 0 -938 0 -942 21 -969 l20 -26
                 499 0 499 0 20 26 c21 27 21 31 21 971 l0 944 -25 24 -24 25 -495 0 -495 0
                 -20 -26z m439 -284 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z
                 m460 0 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z m-462 -457 l-3
                 -148 -147 -3 -148 -3 0 151 0 150 150 0 151 0 -3 -147z m460 0 l-3 -148 -147
                 -3 -148 -3 0 151 0 150 150 0 151 0 -3 -147z m-460 -460 l-3 -148 -147 -3
                 -148 -3 0 151 0 150 150 0 151 0 -3 -147z m460 0 l-3 -148 -147 -3 -148 -3 0
                 151 0 150 150 0 151 0 -3 -147z m-458 -458 l0 -145 -150 0 -150 0 0 145 0 145
                 150 0 150 0 0 -145z m460 0 l0 -145 -150 0 -150 0 0 145 0 145 150 0 150 0 0
                 -145z" />
                                   <path d="M3311 2484 c-21 -27 -21 -31 -21 -969 0 -938 0 -942 21 -969 l20 -26
                 499 0 499 0 20 26 c21 27 21 31 21 969 0 938 0 942 -21 969 l-20 26 -499 0
                 -499 0 -20 -26z m439 -284 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0
                 -150z m460 0 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z m-460
                 -460 l0 -150 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z m460 0 l0 -150
                 -150 0 -150 0 0 150 0 150 150 0 150 0 0 -150z m-460 -460 l0 -150 -150 0
                 -150 0 0 150 0 150 150 0 150 0 0 -150z m460 0 l0 -150 -150 0 -150 0 0 150 0
                 150 150 0 150 0 0 -150z m-460 -455 l0 -145 -150 0 -150 0 0 145 0 145 150 0
                 150 0 0 -145z m460 0 l0 -145 -150 0 -150 0 0 145 0 145 150 0 150 0 0 -145z" />
                </g>
              </svg>
            </div>
          </div>
        </div>


        <?php include('include/footer.php'); ?>
      </div>
    </div>
  </div>


  <?php include('include/javascript.php'); ?>
  <script src="../assets/js/circular.js"></script>
  <script src="f-assets/dashboard-chart.js"></script>


</body>

</html>