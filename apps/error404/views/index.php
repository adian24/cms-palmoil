<?php defined('BASEPATH') OR exit("No direct script access allowed");?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Where are you going ???</h3>
            </div>
            <div class="box-body">
				<div class="row">
					<div class="col-sm-4">
						<div class="found-image">
							<img src="<?php echo base_url('assets/images/404.jpg'); ?>" alt="Page not found - <?=$site['title']?>" class="img-responsive">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="found-info">
							<h1>404</h1>
							<h2>Page Not Found</h2>
							<p>We can't seem to find the page you're looking for.</p>
							<a href="<?=base_url()?>" class="btn btn-primary">Back to home</a>
						</div>
					</div>
				</div>
            </div>
        </div>
    </section>
</div>