<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #3b82f6; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #1e40af; margin: 0; font-size: 22px; }
        .project-name { color: #6b7280; font-size: 14px; margin-top: 5px; }
        .content { background: #f9fafb; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $update->title }}</h1>
        <p class="project-name">Project: {{ $project->title }}</p>
    </div>

    <div class="content">
        {!! $update->content !!}
    </div>

    <div class="footer">
        <p>This update was sent by Olotin Temitope regarding your project.</p>
        <p>If you have questions, please reply to this email.</p>
    </div>
</body>
</html>
