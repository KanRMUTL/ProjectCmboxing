@if($errors->has($input))
<div class="invalid-feedback">
     {{ $errors->first($input) }}
</div>
@endif