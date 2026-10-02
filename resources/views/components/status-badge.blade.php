@props([
    'status',
])

@php
    $normalized = strtolower(
        str_replace([' ', '-'], '_', $status)
    );

    $styles = [
        // Success / completed states
        'available' => 'bg-[#168A72]/10 text-[#126E5B]',
        'completed' => 'bg-[#168A72]/10 text-[#126E5B]',
        'returned' => 'bg-[#168A72]/10 text-[#126E5B]',

        // PULSO functional / approved states
        'approved' => 'bg-[#05ADB6]/10 text-[#058D95]',

        // Operational / in-progress states
        'borrowed' => 'bg-[#2878C8]/10 text-[#246AAE]',
        'deployed' => 'bg-[#2878C8]/10 text-[#246AAE]',
        'preparing' => 'bg-[#2878C8]/10 text-[#246AAE]',
        'ready' => 'bg-[#2878C8]/10 text-[#246AAE]',
        'released' => 'bg-[#2878C8]/10 text-[#246AAE]',

        // Review / waiting states
        'submitted' => 'bg-[#D99120]/12 text-[#A76A12]',
        'under_review' => 'bg-[#D99120]/12 text-[#A76A12]',
        'pending' => 'bg-[#D99120]/12 text-[#A76A12]',

        // Maintenance / attention states
        'maintenance' => 'bg-[#D87520]/10 text-[#B85F16]',
        'under_maintenance' => 'bg-[#D87520]/10 text-[#B85F16]',

        // Destructive / exception states
        'damaged' => 'bg-[#D64545]/10 text-[#B73737]',
        'rejected' => 'bg-[#D64545]/10 text-[#B73737]',
        'overdue' => 'bg-[#D64545]/10 text-[#B73737]',
        'for_disposal' => 'bg-[#D64545]/10 text-[#B73737]',

        // Inactive states
        'archived' => 'bg-[#7B8494]/10 text-[#667085]',
    ];

    $class = $styles[$normalized]
        ?? 'bg-[#F2F4F7] text-[#475467]';
@endphp

<span
    {{ $attributes->merge([
        'class' => "
            inline-flex
            min-h-[28px]
            items-center
            justify-center
            whitespace-nowrap
            rounded-full
            px-3
            py-1.5
            text-xs
            font-semibold
            leading-none
            {$class}
        "
    ]) }}
>
    {{ $status }}
</span>