<?php
$alert_bar_active = get_field('alert_bar_active', 'option');
$alert_bar = get_field('alert_bar', 'option', false);
if ($alert_bar_active) {
	echo '<div class="alert-bar"><div class="alert-bar-text">' . $alert_bar . ' </div></div>';
?>
<style>
.alert-bar {
	background: #D0ECFD;
	color: #707070;
	text-align: center;
	min-height: 46px;
	padding: 2px 10px;
	display: flex;
	justify-content: center;
	align-items: center;
	//box-shadow: 0px 3px 25px #040C1DDB;
	position: relative;
	z-index: 1000;
	font-size: 16px;
}

.alert-bar .alert-bar-text {
	color: #4B4B4B;
	color: #646464;
	font-size: 18px;
	font-weight: bold;
	font-weight: 600;
	font-family: "Nunito Sans",sans-serif;
}

.alert-bar a {
	color: #6229A8;
	//font-weight: bold;
	text-decoration: underline;
}

.alert-bar a:hover {
	color: #1B55CC;
}
</style>
<?php } ?>