<div class="row" id="weekly-header">
    <div class="col-md-12 text-center">
        <h3>Weekly View Calendar</h3>
    </div>
    <div class="col-md-6">
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Process</label>
                <div class="col-sm-4">
                    <p class="form-control-static">{{ $process->name }}</p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Equipment</label>
                <div class="col-sm-4">
                    {{ Form::select(null, $process->equipments()->orderBy('order')->lists('name', 'id'), null, array('class' => 'form-control weekly-eq')) }}
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row" id="weekly-range">
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon" style="background:#fff">
                        <span style="font-size: 14px;margin:0px;" class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input type="text" class="form-control week-picker" value="" disabled="disabled">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 text-center" style="padding-left:4px;padding-right: 5px;">        
        <button type="button" class="btn btn-default weekRefresh" style="width: 100%;">
            <span class="glyphicon glyphicon-refresh" style="margin-right:0px;"></span>
        </button>
    </div>
</div>

<div id="weekly"></div>