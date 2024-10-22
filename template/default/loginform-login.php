<?php
if (headers_sent($file, $line)) {
}

if (!isset($_SESSION['username'])) {
    $isLoggedIn = 1;
}else {
    $isLoggedIn = 0;
    $user_trial = $_SESSION['username'];
}

function getBillingPlans() {
    require_once './config/mysqli_db.php';
    $sql = "SELECT planName, planCost FROM billing_plans WHERE planCost > 0 ORDER BY planCost LIMIT 4";
    $result = $conn->query($sql);

    $plans = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $plans[] = $row;
        }
    }

    $conn->close();
    
    return $plans;
}

$billingPlans = getBillingPlans();

if (isset($_GET['mac'])) {
    $mac = $_GET['mac'];
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>LOGIN</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.svg" sizes="32x32">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">		
        <div class="left">
            <div class="headerButton">
                <div class="form-check form-switch">
                    <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                    <label class="form-check-label" for="darkmodeSwitch"></label>
                </div>
            </div>
        </div>
        <div class="pageTitle">
            <script src="assets/config/namawifi.js"></script>
        </div>
        <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#DialogIconedInfo">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
                    <path fill="#ffffff" d="M10 21H14C14 22.1 13.1 23 12 23S10 22.1 10 21M21 19V20H3V19L5 17V11C5 7.9 7 5.2 10 4.3V4C10 2.9 10.9 2 12 2S14 2.9 14 4V4.3C17 5.2 19 7.9 19 11V17L21 19M17 11C17 8.2 14.8 6 12 6S7 8.2 7 11V18H17V11Z" />
                </svg>
                <span class="badge badge-danger">1</span>
            </a>
        </div>
    </div>
    <!-- * App Header -->
	
    <!-- DialogIconedInfo -->
    <div class="modal fade dialogbox" id="DialogIconedInfo" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="48" height="48" viewBox="0 0 24 24">
                        <path fill="#6236FF" d="M12 12C9.97 12 8.1 12.67 6.6 13.8L4.8 11.4C6.81 9.89 9.3 9 12 9S17.19 9.89 19.2 11.4L17.92 13.1C17.55 13.17 17.18 13.27 16.84 13.41C15.44 12.5 13.78 12 12 12M21 9L22.8 6.6C19.79 4.34 16.05 3 12 3S4.21 4.34 1.2 6.6L3 9C5.5 7.12 8.62 6 12 6S18.5 7.12 21 9M12 15C10.65 15 9.4 15.45 8.4 16.2L12 21L13.04 19.61C13 19.41 13 19.21 13 19C13 17.66 13.44 16.43 14.19 15.43C13.5 15.16 12.77 15 12 15M17.75 19.43L16.16 17.84L15 19L17.75 22L22.5 17.25L21.34 15.84L17.75 19.43Z" />
                    </svg>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title"><script src="assets/config/namawifi.js"></script></h5>
                </div>
                <div class="modal-body">
                <?php if ($isLoggedIn == 1): ?>Anda belum login!!!<?php endif; ?>
                <?php if ($isLoggedIn == 0): ?><?php echo "<p>Hi " . htmlspecialchars($_SESSION['username']) . "</p>"; ?><?php endif; ?>
                
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn" data-bs-dismiss="modal">OKE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * DialogIconedInfo -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <font color="#6104FF">
                    <center>
                        <b>
                            <script type="text/javascript">
                                var months = ["JANUARI", "FERBUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"],
                                    myDays = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUM&#39; AT", "SABTU"],
                                    date = new Date,
                                    day = date.getDate(),
                                    month = date.getMonth(),
                                    thisDay = myDays[thisDay = date.getDay()],
                                    yy = date.getYear(),
                                    year = yy < 1e3 ? yy + 1900 : yy;
                                document.write(thisDay + ", " + day + " " + months[month] + " " + year)
                            </script>
                        </b>
                    </center>
                    <center>
                        <b>
                            <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                        </b>
                    </center>
                    <script type="text/javascript">
                        function showTime() {
                            var e = new Date,
                                t = e.getHours(),
                                n = e.getMinutes(),
                                o = e.getSeconds(),
                                i = "AM";
                            0 == t && (t = 12), 12 < t && (t -= 12, i = "PM");
                            var s = (t = t < 10 ? "0" + t : t) + ":" + (n = n < 10 ? "0" + n : n) + ":" + (o = o < 10 ? "0" + o : o) + " " + i;
                            document.getElementById("MyClockDisplay").innerText = s, document.getElementById("MyClockDisplay").textContent = s, setTimeout(showTime, 1e3)
                        }
                        showTime()
                    </script>
                    <font color="#FFFFFF">
                        <div class="left">
                        <center>
                                <h4 class="total">Akses Internet Tanpa Batasan Kuota</h4>
                            </center>
                        </div>
                        <center>
                            <form action="<?php echo $loginpath; ?>" method="post" name="Login_Form">
                                <input type="hidden" name="challenge" value="<?php echo $challenge; ?>">
                                <input type="hidden" name="uamip" value="<?php echo $uamip; ?>">
                                <input type="hidden" name="uamport" value="<?php echo $uamport; ?>">
                                <input type="hidden" name="userurl" value="<?php echo $userurl; ?>">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <input type="text" id="idusr" class="form-control" style="text-align:center;" name="UserName" placeholder="Masukan Kode Voucher" required="" autofocus="">
                                        <input type="hidden" name="button" value="Login">

                                        <i class="clear-input">
                                            <a href="#" onclick="resetForm()">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path fill="#FF5C93" d="M12 1A11 11 0 0 0 1 12h2A9 9 0 1 1 12 3v3l5 2.5-5 2.5V8a8 8 0 1 0 0 16 8 8 0 0 0 8-8h2a10 10 0 0 1-10 10z" />
                                                </svg>
                                            </a>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-button">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </div>
                            </form>
                        </center>
                    </font>
                </font>
                
                <?php if ($isLoggedIn == 1): ?>
                <div class="wallet-footer">
                    <div class="item">
                        <a href="./index.php?mac=<?php echo "$mac" ?>">
                            <div class="icon-wrapper bg-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="#ffffff" d="M10 12C12.21 12 14 10.21 14 8S12.21 4 10 4 6 5.79 6 8 7.79 12 10 12M10 6C11.11 6 12 6.9 12 8S11.11 10 10 10 8 9.11 8 8 8.9 6 10 6M12 20H2V17C2 14.33 7.33 13 10 13C10.91 13 12.13 13.16 13.35 13.47C13.26 13.8 13.2 14.15 13.2 14.5V15.39C12.22 15.1 11.1 14.9 10 14.9C7.03 14.9 3.9 16.36 3.9 17V18.1H12C12 18.13 12 18.17 12 18.2V20M20.8 17H16.5V14.5C16.5 13.7 17.2 13.2 18 13.2S19.5 13.7 19.5 14.5V15H20.8V14.5C20.8 13.1 19.4 12 18 12S15.2 13.1 15.2 14.5V17C14.6 17 14 17.6 14 18.2V21.7C14 22.4 14.6 23 15.2 23H20.7C21.4 23 22 22.4 22 21.8V18.3C22 17.6 21.4 17 20.8 17Z" />
                                </svg>
                            </div>
                            <strong>MEMBER</strong>
                        </a>
                    </div>
                
                        <div class="item">
                            <a href="./profile/register.php?mac=<?php echo "$mac" ?>">
                                <div class="icon-wrapper bg-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M7 4C4.8 4 3 5.8 3 8S4.8 12 7 12 11 10.2 11 8 9.2 4 7 4M7 10C5.9 10 5 9.1 5 8S5.9 6 7 6 9 6.9 9 8 8.1 10 7 10M7 14C3.1 14 0 15.8 0 18V20H11V18H2C2 17.4 3.8 16 7 16C8.8 16 10.2 16.5 11 17V14.8C9.9 14.3 8.5 14 7 14M22 4H15C13.9 4 13 4.9 13 6V18C13 19.1 13.9 20 15 20H22C23.1 20 24 19.1 24 18V6C24 4.9 23.1 4 22 4M16 18H15V6H16V18M22 18H18V6H22V18Z" />
                                    </svg>
                                </div>
                                <strong>DAFTAR</strong>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($isLoggedIn == 0): ?>
                <div class="wallet-footer">
					<div class="item">
                      <a href="./profile/profile.php?mac=<?php echo "$mac" ?>">
                            <div class="icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 14 14"><path fill="currentColor" fill-rule="evenodd" d="M1.573 1.573A.25.25 0 0 1 1.75 1.5h1.5a.75.75 0 0 0 0-1.5h-1.5A1.75 1.75 0 0 0 0 1.75v1.5a.75.75 0 0 0 1.5 0v-1.5a.25.25 0 0 1 .073-.177M14 10.75a.75.75 0 0 0-1.5 0v1.5a.25.25 0 0 1-.25.25h-1.5a.75.75 0 0 0 0 1.5h1.5A1.75 1.75 0 0 0 14 12.25zM.75 10a.75.75 0 0 1 .75.75v1.5a.25.25 0 0 0 .25.25h1.5a.75.75 0 0 1 0 1.5h-1.5A1.75 1.75 0 0 1 0 12.25v-1.5A.75.75 0 0 1 .75 10m10-10a.75.75 0 0 0 0 1.5h1.5a.25.25 0 0 1 .25.25v1.5a.75.75 0 0 0 1.5 0v-1.5A1.75 1.75 0 0 0 12.25 0zM7 7.776a4.42 4.42 0 0 0-4.145 2.879c-.112.299.127.595.446.595h7.396c.32 0 .558-.296.447-.595a4.42 4.42 0 0 0-4.145-2.879Zm2.208-3.315a2.21 2.21 0 1 1-4.421 0a2.21 2.21 0 0 1 4.421 0" clip-rule="evenodd"/>
                                </svg>
							</div>
                            <strong>PROFILE</strong>
                        </a>
                    </div>
                    
					<div class="item">
                      <a href="./payment/topup.php?mac=<?php echo "$mac" ?>">
                            <div class="icon-wrapper bg-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M12 19c-1.332.622-3.083 1-5 1c-1.066 0-2.08-.117-3-.327c-.591-.136-.887-.203-1.241-.484a2.4 2.4 0 0 1-.565-.709C2 18.073 2 17.677 2 16.886V6.114c0-.985 1.04-1.661 2-1.441c.92.21 1.934.327 3 .327c1.917 0 3.668-.378 5-1s3.083-1 5-1c1.066 0 2.08.117 3 .327c.591.136.887.204 1.241.484c.202.16.454.476.565.709c.194.408.194.803.194 1.594V11.5M18.5 21v-7M15 17.5h7"/><path d="M14.5 11.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0m-9 1v.009"/></g>
                                </svg>
							</div>
                            <strong>TOPUP</strong>
                        </a>
                    </div>
                    
                    <div class="item">
                        <a href="./utilities/voucher.php?mac=<?php echo "$mac" ?>">
                            <div class="icon-wrapper bg-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M4 4a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2a2 2 0 0 1-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 1-2-2a2 2 0 0 1 2-2V6a2 2 0 0 0-2-2zm11.5 3L17 8.5L8.5 17L7 15.5zm-6.69.04c.98 0 1.77.79 1.77 1.77a1.77 1.77 0 0 1-1.77 1.77c-.98 0-1.77-.79-1.77-1.77a1.77 1.77 0 0 1 1.77-1.77m6.38 6.38c.98 0 1.77.79 1.77 1.77a1.77 1.77 0 0 1-1.77 1.77c-.98 0-1.77-.79-1.77-1.77a1.77 1.77 0 0 1 1.77-1.77"/>
                                </svg>
							</div>
                            <strong>VOUCHER</strong>
                        </a>
                    </div>
                    
                    <div class="item">
                        <div class="icon-wrapper bg-warning" onclick="goToVoucher();" style="cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5zm-2 16l-4-4l1.41-1.41L10 14.17l6.59-6.59L18 9z"/>
                            </svg>
                        </div>
                        <strong onclick="goToVoucher();" style="cursor: pointer;">GRATIS</strong>
                    </div>

                    <script>
                        function goToVoucher() {
                            window.location.href = "./utilities/trial.php?mac=<?php echo $mac; ?>&user=<?php echo $user_trial; ?>";
                        }
                    </script>

                </div>
                <!-- * Wallet Footer -->
            <?php endif; ?>
        </div>
        </div>
        <!-- Wallet Card -->

        <!-- Paket Unggulan -->
        <div class="section">
            <div class="row mt-2">
                <?php foreach ($billingPlans as $index => $plan): ?>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="title"><center><?php echo htmlspecialchars($plan["planName"]); ?></center></div>
                            <div class="value <?php 
                                switch ($index % 4) {
                                    case 0: echo 'text-success'; break;
                                    case 1: echo 'text-danger'; break;
                                    case 2: echo 'text-warning'; break;
                                    case 3: echo 'text-primary'; break;
                                }
                            ?>"><center>Rp <?php echo number_format($plan["planCost"], 0, ',', '.'); ?></center></div>
                        </div>
                    </div>
                    <?php if (($index + 1) % 2 == 0): ?>
                        </div>
                        <div class="row mt-2">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <br />
        <!-- * Paket Unggulan -->

        <font color='#6104FF'>
            <!-- app footer -->
            <div class="appFooter">
                <div class="footer-title">
                Support by <script src="assets/config/supported.js"></script>
            </div>
        </div>
        <!-- * app footer -->

        </div>
        <!-- * App Capsule -->

        <!-- Menu Bawah -->
        <div class="appBottomMenu">
        <a href="#" class="item active">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M17 14H19V17H22V19H19V22H17V19H14V17H17V14M5 20V12H2L12 3L22 12H17V10.19L12 5.69L7 10.19V18H12C12 18.7 12.12 19.37 12.34 20H5Z" />
				</svg>
				<strong>Beranda</strong>
            </div>
        </a>
        <a href="./utilities/paket.php?mac=<?php echo "$mac" ?>" class="item">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M19 23.3L18.4 22.8C16.4 20.9 15 19.7 15 18.2C15 17 16 16 17.2 16C17.9 16 18.6 16.3 19 16.8C19.4 16.3 20.1 16 20.8 16C22 16 23 16.9 23 18.2C23 19.7 21.6 20.9 19.6 22.8L19 23.3M18 2C19.1 2 20 2.9 20 4V13.08L19 13L18 13.08V4H13V12L10.5 9.75L8 12V4H6V20H13.08C13.2 20.72 13.45 21.39 13.8 22H6C4.9 22 4 21.1 4 20V4C4 2.9 4.9 2 6 2H18Z" />
				</svg>
				<strong>Paket</strong>
            </div>
        </a>
		<a href="https://maizil41.github.io/scanner/" class="item">
            <div class="col">
                <div class="action-button large">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#ffffff" d="M4,4H10V10H4V4M20,4V10H14V4H20M14,15H16V13H14V11H16V13H18V11H20V13H18V15H20V18H18V20H16V18H13V20H11V16H14V15M16,15V18H18V15H16M4,20V14H10V20H4M6,6V8H8V6H6M16,6V8H18V6H16M6,16V18H8V16H6M4,11H6V13H4V11M9,11H13V15H11V13H9V11M11,6H13V10H11V6M2,2V6H0V2A2,2 0 0,1 2,0H6V2H2M22,0A2,2 0 0,1 24,2V6H22V2H18V0H22M2,18V22H6V24H2A2,2 0 0,1 0,22V18H2M22,22V18H24V22A2,2 0 0,1 22,24H18V22H22Z" />
				</svg>
                </div>
            </div>
        </a>
		<a href="./utilities/faq.php?mac=<?php echo "$mac" ?>" class="item">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M18,15H6L2,19V3A1,1 0 0,1 3,2H18A1,1 0 0,1 19,3V14A1,1 0 0,1 18,15M23,9V23L19,19H8A1,1 0 0,1 7,18V17H21V8H22A1,1 0 0,1 23,9M8.19,4C7.32,4 6.62,4.2 6.08,4.59C5.56,5 5.3,5.57 5.31,6.36L5.32,6.39H7.25C7.26,6.09 7.35,5.86 7.53,5.7C7.71,5.55 7.93,5.47 8.19,5.47C8.5,5.47 8.76,5.57 8.94,5.75C9.12,5.94 9.2,6.2 9.2,6.5C9.2,6.82 9.13,7.09 8.97,7.32C8.83,7.55 8.62,7.75 8.36,7.91C7.85,8.25 7.5,8.55 7.31,8.82C7.11,9.08 7,9.5 7,10H9C9,9.69 9.04,9.44 9.13,9.26C9.22,9.08 9.39,8.9 9.64,8.74C10.09,8.5 10.46,8.21 10.75,7.81C11.04,7.41 11.19,7 11.19,6.5C11.19,5.74 10.92,5.13 10.38,4.68C9.85,4.23 9.12,4 8.19,4M7,11V13H9V11H7M13,13H15V11H13V13M13,4V10H15V4H13Z" />
				</svg>
				<strong>FAQ</strong>
            </div>
        </a>
        <a href="./utilities/kontak.php?mac=<?php echo "$mac" ?>" class="item">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M6,17C6,15 10,13.9 12,13.9C14,13.9 18,15 18,17V18H6M15,9A3,3 0 0,1 12,12A3,3 0 0,1 9,9A3,3 0 0,1 12,6A3,3 0 0,1 15,9M3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3H5C3.89,3 3,3.9 3,5Z" />
				</svg>
				<strong>Kontak</strong>
            </div>
        </a>
    </div>

<script src="assets/js/lib/bootstrap.bundle.min.js"></script>
<!-- Base Js File -->
<script src="assets/js/base.js"></script>
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/custom.js">
</span>
</div>

</body>

</html>