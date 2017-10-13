
# lutian/PHPAvatarStylizer

> text processing


Define automatically background color and text color depends on avatar predominant color

### Version
1.0.0

### Authors

* [Luciano Salvino] - <lsalvino@hotmail.com>


### Installation

To use the tools of this repo only has to be required in your composer.json:

```
{
   "require":{
      "lutian/PHPAvatarStylizer": "dev-master"
   }
}
```


### Use

```

require __DIR__ . '/PHPAvatarStylizer.php';

// Call class. Constructor have $showInverse variable defined on FALSE by default. If set to TRUE then text color will be the oposite of background color. Otherwise will be black if background is light or white if background is dark.
$avatarStylizer = new \PHPAvatarStylizer\PHPAvatarStylizer();

// Define the path of the avatar image
$avatarPath = 'images/avatarDemo1.jpg';

// Define users information
$userName = 'Lutian_the_Martian';

$userDesc = 'Give Me that Elephant!';

// Let's do the magic
$avatarStylizer->getColorFromImage($avatarPath);

?>
<style>
.bgAvatar {
	background-color: <?php echo $avatarStylizer->bgColor;?>;
	width: 400px;
	height: 140px;
	padding: 20px;
}
.imgAvatar {
	float: left;
	background-image: url('<?php echo $avatarPath;?>');
	width: 120px;
	height: 120px;
	background-size: cover;
	border-radius: 50%;
}
.detailAvatar {
	float: left;
	width: 240px;
}
.title {
	margin-left: 20px;
	color: <?php echo $avatarStylizer->txtColor;?>;
	font-family: Arial;
	font-size: 22px;
} 
.desc {
	margin-left: 20px;
	color: <?php echo $avatarStylizer->txtColor;?>;
	font-family: Arial;
	font-size: 16px;
} 
</style>
<div class="bgAvatar">
	<div class="imgAvatar"></div>
	<div class="detailAvatar">
		<h2 class="title"><?php echo $userName;?></h2>
		<h3 class="desc"><?php echo $userDesc;?></h3>
	</div>
</div>


```


License
----

MIT


[Luciano Salvino]:http://getwayto.me/


