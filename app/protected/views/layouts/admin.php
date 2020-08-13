<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400" rel="stylesheet">
    <link href="/css/style.css?0.28" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="/js/ijs/i.js"></script>
</head>
<body>
  <header>
    <div class="center">
      <div class="user_block right">
        <img class="right" src="/media/Input/Icons/ava_default2x.png"/>
        <div class="right text">
          <div class="login_row">admin</div>
          <a href="/site/logout"><div class="logout right">Logout</div></a>
        </div>
      </div>

	<?php echo $content; ?>
  <script src="/js/search.js?1.50"></script>
  <script>
  		window.ijs = new Ijs({path:'/js/ijs/'});
  </script>
</body>
</html>
