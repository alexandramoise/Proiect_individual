
<html>
<head>
<style>
        *{
    margin:0;
    padding:0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #EEA9E9;
}

nav {
    background: white;
}

nav::after {
    content: ' ';
    clear: both;
    display: table;
}

nav .logo {
    float: left;
    color: #CF3AC0; 
    font-size: 27px;
    font-family: "Lucida Handwriting", cursive;
    font-weight: 600;
    line-height: 70px;
    padding-left: 60px;
}
nav ul{
    float: right;
    list-style: none;
    margin-right: 40px;
    position: relative;
}

nav ul li{
    float: left;
    display: inline-block;
    background: white;
    margin: 0 5px;
}

nav ul li a{
    color: #cc0099;
    text-decoration: none;
    line-height: 70px;
    font-size: 18px;
    padding: 8px 15px;
}

nav ul li a:hover{
    color: #B51895;
    border-radius: 5px;
    box-shadow: 0 0 5px #CF3AC0;
}

nav ul ul li a:hover {
    color: #cc0099;
    box-shadow: 0 0 5px #CF3AC0;
}

nav ul ul {
    position: absolute;
    top: 100px;
    opacity: 0;
    visibility: hidden;
    transition: top .3s;
}

nav ul li:hover > ul{
    top: 70px;
    opacity: 1;
    visibility: visible;
}
nav ul ul li {
    position: relative;
    margin: 0px;
    width: 100px;
    float: none;
    display: list-item;

}
a{
    text-decoration: none;
}

</style>
</head>
<body>
<nav>
    <a href="#" class="logo"> La Ana </a>
    <ul>
        <li><a href="stoc.php"> Stoc </a></li>
        <li> <a href="orders.php"> Comenzi </a>
        <li> <a href="homepage.html"> Home </a> </li>
    </ul>
</nav>
</body>

</html>