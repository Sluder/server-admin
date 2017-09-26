
<div class="modal fade" id="reboot-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Reboot the hosting server</h4>
                <form action="{{ route('server.reboot') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="password">Server Password</label>
                                {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn custom-btn" type="submit">Reboot</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
