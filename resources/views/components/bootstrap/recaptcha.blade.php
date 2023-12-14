@if (config('services.recaptcha.key'))
    <div class="mb-5">
        <div class="g-recaptcha mb-3" data-sitekey="{{ config('services.recaptcha.key') }}"></div>

        @error('g-recaptcha-response')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
@endif
