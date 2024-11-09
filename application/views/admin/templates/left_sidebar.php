<?php
  $user_id = $this->session->userdata('user_id');
  $role = $this->session->userdata('user_role_id');
?>
<!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar" style="position:absolute;">
        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">
          	<ul class="sidebar-menu">
          		<li class="treeview" id="app_all">
					<a href="<?php echo base_url('chome/register_admin')?>" target="_blank">
						<i>NEW</i> <span> / New App Form</span>
					</a>
				</li>
				<li class="treeview" id="login">
					<a href="<?php echo base_url('admin/clogin/user_login')?>" target="_blank">
						<i>EDIT</i> <span> / New App Form</span>
					</a>
				</li>
				<li class="treeview" id="app_sb">
					<a href="<?php echo base_url('admin/cmaster/sibling')?>">
						<i>SB</i> <span> / Sibling </span>
					</a>
				</li>

            	<li class="treeview" id="app_pending">
              		<a href="<?php echo base_url('admin/cmaster')?>">
                		<i>P</i> <span> / Pending </span>
              		</a>
            	</li>
				<li class="treeview" id="app_ia">
					<a href="<?php echo base_url('admin/cmaster/incomplete')?>">
						<i>IA</i> <span> / Incomplete </span>
					</a>
				</li>
				<li class="treeview" id="app_pnp">
					<a href="<?php echo base_url('admin/cmaster/photo_not_proper')?>">
						<i>PNP</i> <span> / Photo not Proper </span>
					</a>
				</li>
				<li class="treeview" id="app_pnd">
					<a href="<?php echo base_url('admin/cmaster/pay_not_done')?>">
						<i>PND</i> <span> / Payment not done </span>
					</a>
				</li>
				<li class="treeview" id="app_apd">
					<a href="<?php echo base_url('admin/cmaster/print_done')?>">
						<i>APD</i> <span> / Print Done </span>
					</a>
				</li>
				<li class="treeview" id="app_test_exam">
					<a href="<?php echo base_url('admin/cmaster/test_exam')?>">
						<i>TE</i> <span> / Test Exam </span>
					</a>
				</li>
				<li class="treeview" id="app_is">
					<a href="<?php echo base_url('admin/cmaster/interview_schedule')?>">
						<i>IS</i> <span> / Interview Schedule </span>
					</a>
				</li>
				<li class="treeview" id="app_ar">
					<a href="<?php echo base_url('admin/cmaster/rejected')?>">
						<i>AR</i> <span> / Rejected </span>
					</a>
				</li>
				<li class="treeview" id="app_ac">
					<a href="<?php echo base_url('admin/cmaster/admission_confirm')?>">
						<i>AC</i> <span> / Admission Confirm </span>
					</a>
				</li>
				<li class="treeview" id="app_fnp">
					<a href="<?php echo base_url('admin/cmaster/fees_not_paid')?>">
						<i>PS</i> <span> / Provisional Selection </span>
					</a>
				</li>
				<li class="treeview" id="app_all">
					<a href="<?php echo base_url('admin/cmaster/all_application')?>">
						<i>ALL</i> <span> / All Application </span>
					</a>
				</li>

				<li class="treeview" id="report">
					<a href="<?php echo base_url('admin/cmaster/report')?>">
						<i>RP</i> <span> / Report </span>
					</a>
				</li>
				<li class="treeview" id="app_progress">
					<a href="<?php echo base_url('admin/cmaster/app_progress')?>">
						<i>RP</i> <span> / Progress </span>
					</a>
				</li>
				<li class="treeview" id="app_recycle_bin">
					<a href="<?php echo base_url('admin/cmaster/recycle_bin')?>">
						<i>RB</i> <span> / Recycle Bin </span>
					</a>
				</li>
				<li class="treeview" id="gallery">
					<a href="<?php echo base_url('admin/gallery_cmaster?action=view')?>">
						<i>GI</i> <span> / Gallery </span>
					</a>
				</li>
				<!-- <li class="treeview" id="search">
                   	<a href="<?php echo base_url('admin/cmaster/search')?>">
                      <i>SR</i> <span> / SEARCH </span>
                   </a>
				</li> -->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

