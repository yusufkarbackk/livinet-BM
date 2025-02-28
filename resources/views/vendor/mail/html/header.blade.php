@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="/storage/images/livinet-logo.png" class="logo" alt="Livinet Logo">
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>