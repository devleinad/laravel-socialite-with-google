<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SocialApp</title>
        <div style="text-align:center">
            @if(auth()->user())
                <div>
                    <div>
                        <img src="{{auth()->user()->avatar}}" width="100px"/>
                    </div>
                    <div>
                        <p>ID: {{auth()->id()}}</p>
                        <p>Name: {{auth()->user()->name}}</p>
                        <p>Email: {{auth()->user()->email}}</p>
                        <p>ProviderId: {{auth()->user()->provider_id}}</p>
                    </div>
                </div>
            @else
            <div style="margin-top: 20px; text-align:center">
            <a href="/oauth/google" style="font-size: 40px;">Sign in  with Google</a>
            </div>
            @endif
        </div>
        
    </body>
</html>
