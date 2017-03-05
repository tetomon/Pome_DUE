 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
             
              <ul class="nav side-menu">
                <li><a  href="index.php"><i class="fa fa-credit-card"></i> Summary <span class="fa fa-chevron-right"></span></a></li>
                 <li><a  href="in_ex.php"><i class="fa fa-exchange"></i> Income/Expense <span class="fa fa-chevron-right"></span></a></li>
                income/expense
                
               
              </ul>
            </div>
            <!-- Admin Menu -->
             <? if($_SESSION['role']=='Admin' ){ ?>
            <div class="menu_section">
              <h3>For Admin</h3>
              <ul class="nav side-menu">            
                <li><a href="user_mgmt.php"><i class="fa fa-user"></i> User Management <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="credit_mgmt.php"><i class="fa fa-cc-visa"></i> Card Management <span class="fa fa-chevron-right"></span></a></li>
                <li><a href="log_mgmt.php"><i class="fa fa-table"></i> Log Management <span class="fa fa-chevron-right"></span></a></li>
              </ul>
            </div>
            <?}?>
           

          </div>