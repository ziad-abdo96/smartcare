<label>Role Name</label>
<x-form.input name="name" value="{{ optional($role)->name }}" placeholder="Enter Role Name" />



<fieldset>
    <legend>{{ _('Abilities') }}</legend>
</fieldset>
@foreach (config('abilities') as $ability_code => $ability_name)
    <div class="row mb-2">
        <div class="col-md-6">
            {{ $ability_name }}
        </div>
        <div class="col-md-3">
            <input type="radio" name="abilities[{{ $ability_code }}]" value="allow" @checked( ($role_abilities[$ability_code] ?? '') == 'allow' )>
            Allow
        </div>
        <div class="col-md-3">
            <input type="radio" name="abilities[{{ $ability_code }}]" value="deny" @checked(($role_abilities[$ability_code] ?? '')== 'deny') >
            Deny
        </div>
    </div>
@endforeach
<button type="submit" class="btn btn-primary">Save</button>
