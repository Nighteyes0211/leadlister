<div>

    <x-bootstrap.card>
        <x-bootstrap.form>

            <div class="row">
                <div class="col-lg-6">
                    <x-bootstrap.form.input :col="false" name="first_name"
                        label="First name"></x-bootstrap.form.input>
                </div>
                <div class="col-lg-6">
                    <x-bootstrap.form.input :col="false" name="last_name" label="Last name"></x-bootstrap.form.input>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <x-bootstrap.form.input type="email" :col="false" name="email"
                        label="Email"></x-bootstrap.form.input>
                </div>
                <div class="col-lg-6">
                    <x-bootstrap.form.input type="password" :col="false" name="password"
                        label="Password"></x-bootstrap.form.input>
                </div>
            </div>


            <div class="mt-4 d-flex justify-content-end gap-2 align-items-center" >
                <x-bootstrap.button size="md" class="mb-4" color="secondary" href="{{ route('organization.dashboard') }}">Back</x-bootstrap.button>
                <x-bootstrap.form.button action="" :col="false">Submit</x-bootstrap.form.button>
            </div>
        </x-bootstrap.form>

    </x-bootstrap.card>

    <script>
        window.addEventListener('livewire:load', function() {
            $("#contact").change(function() {
                @this.contact = $("#contact").val()
            })
        })
    </script>
</div>
