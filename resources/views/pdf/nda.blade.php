@php
    $locale = app()->getLocale();
    $isRtl = in_array($locale, ['ar', 'he', 'fa', 'ur']);
    $client = $project->client;
    $freelancer = $bid->user;
    $signatureMeta = collect($meta);
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" @if($isRtl) dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 28mm 22mm; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #0f172a;
            font-size: 12px;
            line-height: 1.55;
        }
        .hero {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border-radius: 18px;
            color: #fff;
            padding: 28px 32px;
            margin-bottom: 24px;
        }
        .hero h1 {
            font-size: 20px;
            margin: 0 0 6px 0;
        }
        .hero p {
            margin: 2px 0;
            font-size: 12px;
            opacity: .9;
        }
        .section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #1d4ed8;
            margin-top: 28px;
            margin-bottom: 10px;
        }
        .card {
            background: #f8fafc;
            border-radius: 14px;
            padding: 16px 18px;
            border: 1px solid #e2e8f0;
            margin-bottom: 12px;
        }
        .grid {
            display: table;
            width: 100%;
        }
        .grid .col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .label {
            font-weight: 600;
            font-size: 11px;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: #475569;
            margin-bottom: 4px;
        }
        .value {
            font-size: 12px;
            color: #0f172a;
        }
        .responses ol {
            padding-left: 16px;
            margin: 0;
        }
        .responses li {
            margin-bottom: 10px;
            padding: 12px 14px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        .responses .question {
            font-weight: 600;
            margin-bottom: 6px;
            color: #1e293b;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            background: #fee2e2;
            color: #b91c1c;
            margin-left: 6px;
        }
        .nda-body {
            font-size: 11px;
            color: #1f2937;
        }
        .footer {
            margin-top: 28px;
            font-size: 10px;
            color: #475569;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>{{ __('messages.t_project_nda_heading') }}</h1>
        <p>{{ $project->title }}</p>
        <p>{{ __('messages.t_project_nda_term_label') }}: {{ $termLabel }}</p>
        <p>{{ __('messages.t_project_nda_signature_label') }}: {{ $bid->nda_signature }} @if($bid->nda_signed_at) · {{ format_date($bid->nda_signed_at, config('carbon-formats.long_date_time')) }} @endif</p>
    </div>

    <div class="section-title">{{ __('messages.t_project_brief_questions_heading') }}</div>
    <div class="card">
        <div class="grid">
            <div class="col" style="padding-right: 12px;">
                <div class="label">{{ __('messages.t_project') }}</div>
                <div class="value">{{ $project->title }} · #{{ $project->pid }}</div>
                <div class="label" style="margin-top: 12px;">{{ __('messages.t_employer') }}</div>
                <div class="value">{{ $client->fullname ?? $client->username }}</div>
            </div>
            <div class="col" style="padding-left: 12px;">
                <div class="label">{{ __('messages.t_freelancer') }}</div>
                <div class="value">{{ $freelancer->fullname ?? $freelancer->username }}</div>
                @if ($signatureMeta->get('ip'))
                    <div class="label" style="margin-top: 12px;">IP</div>
                    <div class="value">{{ $signatureMeta->get('ip') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="section-title">{{ __('messages.t_project_nda_scope_label') }}</div>
    <div class="card nda-body">
        {!! nl2br(e($scope)) !!}
    </div>

    <div class="section-title">{{ __('messages.t_project_nda_heading') }}</div>
    <div class="card">
        <div class="grid">
            <div class="col" style="padding-right: 12px;">
                <div class="label">{{ __('messages.t_project_nda_term_label') }}</div>
                <div class="value">{{ $termLabel }}</div>
            </div>
            <div class="col" style="padding-left: 12px;">
                @if ($bid->nda_signed_at)
                    <div class="label">{{ __('messages.t_project_nda_signature_label') }}</div>
                    <div class="value">
                        {{ $bid->nda_signature }}
                        <div style="margin-top:4px; font-size:10px; color:#64748b;">
                            {{ format_date($bid->nda_signed_at, config('carbon-formats.long_date_time')) }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if ($signatureMeta->get('user_agent'))
            <div style="margin-top: 14px;">
                <div class="label">User-Agent</div>
                <div class="value">{{ $signatureMeta->get('user_agent') }}</div>
            </div>
        @endif
    </div>

    @if ($answers->isNotEmpty())
        <div class="section-title">{{ __('messages.t_freelancer_answers') }}</div>
        <div class="card responses">
            <ol>
                @foreach ($answers as $index => $entry)
                    <li>
                        <div class="question">
                            {{ $entry['question'] }}
                            @if (!empty($entry['is_required']))
                                <span class="badge">{{ __('messages.t_required') }}</span>
                            @endif
                        </div>
                        <div class="answer">
                            @if (filled($entry['answer'] ?? null))
                                {!! nl2br(e($entry['answer'])) !!}
                            @else
                                <span style="color:#94a3b8;">{{ __('messages.t_no_answer_provided') }}</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    @endif

    @if (!empty($markdownHtml))
        <div class="section-title">{{ __('messages.t_project_nda_source_document') }}</div>
        <div class="card nda-body">
            {!! $markdownHtml !!}
        </div>
    @endif

    <div class="footer">
        Ta’aquad · {{ now()->format('Y-m-d') }} · {{ url('/') }}
    </div>
</body>
</html>
