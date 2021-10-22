<?php defined('BASEPATH') OR exit("No direct script access allowed");
/***
*
* @Author		: Ryan Irsandi
* @Module       : Company
* @Type         : View
* @Date Create	: 23 April 2019
* @Date Revise	: 24 April 2019
* @Version		: 1.0.1
* @Notes		:	+ Initial Commit
                    (Version 1.0.1) - 02 January 2019
                    + Fixing bug when editing user access
*
***/
?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title mt-5"><?=$page_title?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table id="dt" class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>IP Address</th>
                                    <th>Username</th>
                                    <th>Module</th>
                                    <th>Device</th>
                                    <th>User Agent</th>
                                    <th>Query</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>