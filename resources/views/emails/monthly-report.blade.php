@component('mail::message')
# New monthly report!

Your new monthly report is ready to view, it's attached to this email or view it in the browser (it looks a lot better) below

@component('mail::button', ['url' => '$url'])
View Report
@endcomponent

Thanks,<br>
Marketing @ Stellasoft
@endcomponent