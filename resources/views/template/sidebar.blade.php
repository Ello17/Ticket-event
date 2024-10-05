<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Sidebar Menu with sub-menu | CodingNepal</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
    <div class="btn">
        <span class="fas fa-bars"></span>
    </div>
    <nav class="admin-sidebar sidebar">
        <div class="text">Admin Menu</div>
        <ul>
            <li class="active"><a href="{{ route('homeAdmin') }}">Dashboard</a></li>
            {{-- <li>
                <a href="#" class="feat-btn">Features
                    <span class="fas fa-caret-down first"></span>
                </a>
                <ul class="feat-show">
                    <li><a href="#">Pages</a></li>
                    <li><a href="#">Elements</a></li>
                </ul>
            </li> --}}
            <li>
                <a href="{{ route('kelolaUser') }}" class="serv-btn">Kelola User
                    <span class="fas fa-caret-down second"></span>
                </a>
                <ul class="serv-show">
                    <li><a href="#">App Design</a></li>
                    <li><a href="#">Web Design</a></li>
                </ul>
            </li>
            {{-- <li><a href="#">Portfolio</a></li>
            <li><a href="#">Overview</a></li>
            <li><a href="#">Shortcuts</a></li>
            <li><a href="#">Feedback</a></li> --}}
        </ul>
    </nav>
      <script>
        $('.btn').click(function() {
            $(this).toggleClass("click");
            $('.admin-sidebar').toggleClass("show");
        });

        $('.feat-btn').click(function() {
            $('nav ul .feat-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });

        $('.serv-btn').click(function() {
            $('nav ul .serv-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });

        $('nav ul li').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
        });

      </script>
      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

* {
    margin: 0;
    padding: 0;
    user-select: none;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* Sidebar Button */
.btn {
    position: absolute;
    top: 15px;
    left: 45px;
    height: 45px;
    width: 45px;
    text-align: center;
    background: #1b1b1b;
    border-radius: 3px;
    cursor: pointer;
    transition: left 0.4s ease;
    z-index: 1001; /* Ensure it appears above content */
}

.btn.click {
    left: 260px;
}

.btn span {
    color: white;
    font-size: 28px;
    line-height: 45px;
}

.btn.click span:before {
    content: '\f00d'; /* Icon change to 'X' */
}

/* Sidebar */
.admin-sidebar {
    position: fixed;
    width: 250px;
    height: 100%;
    left: -250px;
    background: #1b1b1b;
    transition: left 0.4s ease;
    z-index: 1000;
}

.admin-sidebar.show {
    left: 0px;
}

.admin-sidebar .text {
    color: white;
    font-size: 25px;
    font-weight: 600;
    line-height: 65px;
    text-align: center;
    background: #1e1e1e;
    letter-spacing: 1px;
}

.admin-sidebar ul {
    background: #1b1b1b;
    height: 100%;
    width: 100%;
    list-style: none;
}

.admin-sidebar ul li {
    line-height: 60px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.admin-sidebar ul li:last-child {
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.admin-sidebar ul li a {
    position: relative;
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding-left: 40px;
    font-weight: 500;
    display: block;
    width: 100%;
    border-left: 3px solid transparent;
}

.admin-sidebar ul li.active a {
    color: cyan;
    background: #1e1e1e;
    border-left-color: cyan;
}

.admin-sidebar ul li a:hover {
    background: #1e1e1e;
}

.admin-sidebar ul ul {
    display: none;
}

.admin-sidebar ul .feat-show.show,
.admin-sidebar ul .serv-show.show1 {
    display: block;
}

.admin-sidebar ul ul li {
    line-height: 42px;
    border-top: none;
}

.admin-sidebar ul ul li a {
    font-size: 17px;
    color: #e6e6e6;
    padding-left: 80px;
}

.admin-sidebar ul li a span {
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    font-size: 22px;
    transition: transform 0.4s;
}

.admin-sidebar ul li a span.rotate {
    transform: translateY(-50%) rotate(-180deg);
}

/* Content Section */
.content {
    margin-left: 270px; /* Ensure content clears the sidebar */
    padding: 20px;
    overflow-x: hidden;
}

      </style>
   </body>
</html>
