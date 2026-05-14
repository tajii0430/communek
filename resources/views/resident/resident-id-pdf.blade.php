<!DOCTYPE html>
</div>

<div class="info-box">

    <strong>Contact Number:</strong>

    {{ $resident->contact_number ?? 'N/A' }}

</div>

<div class="info-box">

    <strong>Age:</strong>

    {{ $age }}

</div>

<div class="info-box">

    <strong>Gender:</strong>

    {{ $resident->gender ?? 'N/A' }}

</div>

<div class="info-box">

    <strong>Civil Status:</strong>

    {{ $resident->civil_status ?? 'N/A' }}

</div>

<div class="info-box">

    <strong>Sitio:</strong>

    {{ $resident->address ?? 'N/A' }}

</div>

<div class="info-box">

    <strong>Barangay:</strong>

    {{ $resident->barangay ?? 'N/A' }}

</div>

<div class="qr-box">

    {!! QrCode::size(140)->generate($qrURL) !!}

</div>

<div class="footer">

    Generated Resident Identification Card

</div>

</div>

</div>

</body>

</html>