<div class="card card-accent-success hide" v-if="step==='will_success'">
    <div class="card-header h3 text-success"><strong>Success!!! </strong>
    </div>
    <form id="success_form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <img src="{{asset('images/will.png')}}" alt="" style="width:100%;height:auto">
                </div>
                <div class="col-md-8 col-sm-12">
                    <?php if($this->ion_auth->is_admin()):?>
                    <section class="admin_will">
                        <h2 class="text-success display-3 text-center">Will has been created successfully!!!</h2>
                        <div class="row mt-5 d-flex justify-content-around">
                            <button class="btn btn-lg btn-primary" id="admin_view"><i class="fa fa-eye"></i>
                                View</button>

                            <button class="btn btn-lg btn-success" id="admin_mail"><i class="fa fa-envelope"></i>
                                Mail</button>
                        </div>
                        <div class="row my-5 d-flex justify-content-around">
                            <a href="<?php echo base_url('will/submission'); ?>" class="btn btn-lg btn-warning"
                               id="success_next" type="submit">
                                Go to submissions <i class="fa fa-paper-plane"></i></a>
                            <a href="<?php echo base_url('willform'); ?>" class="btn btn-lg btn-secondary"
                               id="success_next" type="submit">
                                Create New Will <i class="fa fa-plus"></i></a>
                        </div>
                    </section>
                    <?php endif;?>
                    <?php if(!$this->ion_auth->is_admin()):?>
                    <div class="customer_will">
                        <div class="card-deck mb-3 text-center" id="pay_single">
                            <div class="card mb-4 box-shadow">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Single Will</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">£10 <br><small
                                            style="font-size: medium">(One time)</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4 text-left"
                                        style="font-size:12px;list-style: circle">
                                        <li>Will can be edited anytime</li>
                                        <li>One PDF will be emailed</li>
                                        <li>Assistance upto 6 months</li>
                                        <li>Help center access</li>
                                    </ul>
                                    <a href="<?php echo base_url('products/purchase/1'); ?>" type="button"
                                       class="btn btn-lg btn-block btn-primary purchase">Purchase</a>
                                </div>
                            </div>
                            <div class="card mb-4 box-shadow">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Subscription</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">£5 <small
                                            class="text-muted">/mo</small><br><small style="font-size: medium">(Billed
                                            annually)</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4 text-left"
                                        style="font-size:12px;list-style: circle">
                                        <li>Will can be edited anytime</li>
                                        <li>Life time support</li>
                                        <li>Assistance upto duration of subscription</li>
                                        <li>Help center access</li>
                                    </ul>
                                    <a href="<?php echo base_url('subscription/single');?>" type="button"
                                       class="btn btn-lg btn-block btn-primary purchase">Subscribe</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-deck mb-3 text-center" id="pay_mirror">
                            <div class="card mb-4 box-shadow">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Mirror Will</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">£20 <br><small
                                            style="font-size: medium">(One time)</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4 text-left"
                                        style="font-size:12px;list-style: circle">
                                        <li>Will can be edited anytime</li>
                                        <li>Two PDF's will be emailed</li>
                                        <li>Assistance upto 6 months</li>
                                        <li>Help center access</li>
                                    </ul>
                                    <a href="<?php echo base_url('products/purchase/2'); ?>" type="button"
                                       class="btn btn-lg btn-block btn-primary purchase">Purchase</a>
                                </div>
                            </div>
                            <div class="card mb-4 box-shadow">
                                <div class="card-header">
                                    <h4 class="my-0 font-weight-normal">Subscription</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">£5 <small
                                            class="text-muted">/mo</small><br><small style="font-size: medium">(Billed
                                            annually)</small></h1>
                                    <ul class="list-unstyled mt-3 mb-4 text-left"
                                        style="font-size:12px;list-style: circle">
                                        <li>Will can be edited anytime</li>
                                        <li>Life time support</li>
                                        <li>Assistance upto duration of subscription</li>
                                        <li>Help center access</li>
                                    </ul>
                                    <a href="<?php echo base_url('subscription/mirror');?>" type="button"
                                       class="btn btn-lg btn-block btn-primary purchase">Subscribe</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <div class="form-group d-flex justify-content-between">
                <button class="btn btn-lg btn-primary" id="success_back"><i class="fa fa-arrow-left"></i>
                    Go
                    Back
                </button>
            </div>
        </div>
    </form>
</div>
