<div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
    <div class="d-flex">
        <div class="header-datepicker me-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="feather feather-calendar"></i>
                    </div>
                </div>
                <input class="form-control" placeholder="{{ date('d M Y') }}" type="text" readonly>
            </div>
        </div>
        <div class="header-datepicker me-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="feather feather-clock"></i>
                    </div>
                </div><!-- input-group-prepend -->
                <input id="" type="text" placeholder="{{ date('h:i') }}" class="form-control input-small"
                       readonly>
            </div>
        </div><!-- wd-150 -->
    </div>
</div>
