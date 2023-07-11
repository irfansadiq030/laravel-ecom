@extends('admin.layout.layout')
@section('page_title','General Settings')

@section('content')

<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Setting Form Style</h4>
            <div class="nk-block-des">
                <p>You can make style out your setting related form as per below example.</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">Website Setting</h5>
            </div>
            <form action="#" class="gy-3">
                <div class="row g-3 align-center">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-label" for="site-name">Site Name</label>
                            <span class="form-note">Specify the name of your website.</span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="site-name" value="DashLite Admin Template">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 align-center">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-label">Site Email</label>
                            <span class="form-note">Specify the email address of your website.</span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="site-email" value="info@softnio.com">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 align-center">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-label">Site Copyright</label>
                            <span class="form-note">Copyright information of your website.</span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="site-copyright" value="© 2019, DashLite. All Rights Reserved.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 align-center">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-label">Allow Registration</label>
                            <span class="form-note">Enable or disable registration from site.</span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <ul class="custom-control-group g-3 align-center flex-wrap">
                            <li>
                                <div class="custom-control custom-radio checked">
                                    <input type="radio" class="custom-control-input" checked="" name="reg-public" id="reg-enable">
                                    <label class="custom-control-label" for="reg-enable">Enable</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="reg-public" id="reg-disable">
                                    <label class="custom-control-label" for="reg-disable">Disable</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="reg-public" id="reg-request">
                                    <label class="custom-control-label" for="reg-request">On Request</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row g-3 align-center">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-label">Main Website</label>
                            <span class="form-note">Specify the URL if your main website is external.</span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="site-url" value="https://www.softnio.com">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 align-center">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="form-label" for="site-off">Maintanance Mode</label>
                            <span class="form-note">Enable to make website make offline.</span>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="reg-public" id="site-off">
                                <label class="custom-control-label" for="site-off">Offline</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-lg-7 offset-lg-5">
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- card -->
</div>

@endsection