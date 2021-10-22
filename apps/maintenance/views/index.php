<?php defined('BASEPATH') OR exit("No direct script access allowed");?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">This module is under maintenance</h3>
            </div>
            <div class="box-body">
				<div class="row">
					<div class="col-sm-4">
						<div class="found-image">
							<img src="<?php echo base_url('assets/images/maintenance.png'); ?>" alt="Maintenance - <?=$site['title']?>" class="img-responsive">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="found-info">
							<h1>503</h1>
							<h2>Module under maintenance</h2>
							<p>Currently this module is under maintenance.</p>
							<a href="<?=base_url()?>" class="btn btn-primary">Back to home</a>
						</div>
					</div>
				</div>
            </div>
        </div>
    </section>
</div>