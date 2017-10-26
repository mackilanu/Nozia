<div class="container">
    <style type="text/css">
        .pointer{
        cursor: pointer;
        }
    </style>
    <div class="row">
        <div class="col-sm-4 col-md-3 sidebar">
            <div class="mini-submenu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="list-group">
                <span href="#" class="list-group-item ">
                Start
                <span class="pull-right" id="slide-submenu">
                <i class="fa fa-times"></i>
                </span>
                </span>
                <a id="btn_banner" onclick="change_banner()" class="list-group-item pointer">
                <i class="fa fa-comment-o "></i> Ändra banner
                </a>
                <a id="btn_icon" onclick="change_icon()" class="list-group-item pointer">
                <i class="fa fa-search"></i> Ändra logo
                </a>
                <a id="btn_bg" class="list-group-item pointer" onclick="change_background()">
                <i class="fa fa-bar-chart-o"></i>Ändra bakgrundsfärg
                </a>                  
                <a id="btn_info" class="list-group-item pointer" onclick="change_info()">
                <i class="fa fa-user "></i> Hantera uppgifter
                </a>
                <a id="btn_offers" class="list-group-item pointer" onclick="change_offers()">
                    <i class="fa fa-folder-open-o"></i> Hantera erbjudanden<!-- <span class="badge">14</span> -->
                </a>
                <a id="btn_blog" class="list-group-item pointer" onclick="change_Post()">
                <i class="fa fa-bar-chart-o"></i>Hantera minibloggen
                </a>
                <a id="btn_files" class="list-group-item pointer" onclick="change_files()">
                <i class="fa fa-bar-chart-o"></i>Hantera filer
                </a>                                 
            </div>
        </div>
        <div class="col-sm-8 col-md-9" id="main">
        </div>
    </div>
</div>