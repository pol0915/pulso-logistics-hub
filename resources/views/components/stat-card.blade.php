@props([
    'title',
    'value',
    'subtitle' => null,
    'type' => 'teal',
])

@php
    $styles = [
        'teal' => [
            'iconBg' => 'bg-[#05ADB6]/10',
            'iconText' => 'text-[#058D95]',
        ],

        'green' => [
            'iconBg' => 'bg-[#168A72]/10',
            'iconText' => 'text-[#168A72]',
        ],

        'blue' => [
            'iconBg' => 'bg-[#2878C8]/10',
            'iconText' => 'text-[#2878C8]',
        ],

        'pink' => [
            'iconBg' => 'bg-[#EE1280]/10',
            'iconText' => 'text-[#EE1280]',
        ],

        'orange' => [
            'iconBg' => 'bg-[#D87520]/10',
            'iconText' => 'text-[#D87520]',
        ],

        'red' => [
            'iconBg' => 'bg-[#D64545]/10',
            'iconText' => 'text-[#D64545]',
        ],
    ];

    $selected = $styles[$type] ?? $styles['teal'];
@endphp

<div class="rounded-2xl border border-[#E5EAF0] bg-white p-4 shadow-[0_1px_2px_rgba(16,38,61,0.03)] sm:p-5">
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <p class="text-sm font-medium leading-5 text-[#667085]">
                {{ $title }}
            </p>

            <p class="mt-1.5 text-2xl font-bold tracking-tight text-[#182230] sm:text-[28px] sm:leading-8">
                {{ $value }}
            </p>

            @if ($subtitle)
                <p class="mt-1 text-xs font-medium leading-5 text-[#667085]">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $selected['iconBg'] }} {{ $selected['iconText'] }}">
            {{ $icon }}
        </div>
    </div>
</div>