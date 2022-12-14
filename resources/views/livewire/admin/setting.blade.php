<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">Setting Page</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Setting</a></li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumb-->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Delivery charge in business</div>
                <div class="card-body pb-5 text-center">
                    <input type="checkbox" id="delivery_charge_in_business" class="filled-in chk-col-primary" @if($delivery_charge_in_business) checked="" @endif wire:change="update_delivery_charge_in_business">
                    <label for="delivery_charge_in_business">Active</label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Membership Activation</div>
                <div class="card-body pb-5 text-center">
                    <input type="checkbox" id="membership_activation" class="filled-in chk-col-primary" @if($membership_activation) checked="" @endif wire:change="update_membership_activation">
                    <label for="membership_activation">Active</label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">VAT Activation</div>
                <div class="card-body pb-5 text-center">
                    <input type="checkbox" id="vat_inclusive" class="filled-in chk-col-primary" @if($vat_inclusive) checked="" @endif wire:change="update_vat_inclusive">
                    <label for="vat_inclusive">Active</label>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">BIN Number</div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('bin_number') border-danger @enderror" placeholder="xxx-xxx-xxx" wire:model="bin_number">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" wire:click="update_bin_number"><i class="zmdi zmdi-check-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">VAT Inclusive</div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('vat_percentage') border-danger @enderror" placeholder="xxx-xxx-xxx" wire:model="vat_percentage">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" wire:click="update_vat_percentage"><i class="zmdi zmdi-check-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Online delivery charge</div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('online_delivery_charge') border-danger @enderror" placeholder="xxx-xxx-xxx" wire:model="online_delivery_charge">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" wire:click="update_online_delivery_charge"><i class="zmdi zmdi-check-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End container-fluid-->
