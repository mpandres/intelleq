<!--Navigation Bar-->
<header>
<div class="fixed">
<nav class="top-bar fixed">
  <ul class="title-area">
    <li class="name"><h1><a href="user">intelleq</a></h1></li>
    <li class="toggle-topbar menu-icon"><a href="user"><span></span></a></li>
  </ul>
  <section class="top-bar-section">
    <ul class="right"style="background:rgba(105, 34, 34, 0)">
        <li style="padding-right:10;padding-left:10"><a><?php echo ucfirst($firstname) . " " . ucfirst($lastname); ?></a></li>
        <li style="padding-right:10;padding-left:10"><a class="button radius" href="login/logout">Sign Out</a></li>
        <li style="padding-right:0;padding-left:10">
            <input type="text" placeholder="Search intelleq">
        </li>
    </ul>
  </section>
</div>
</header>