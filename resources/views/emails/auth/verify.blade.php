@extends('emails.emails_template')

@section('body')
    <table class="inner-body"
           align="center"
           width="570"
           cellpadding="0"
           cellspacing="0"
           style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
        <!-- Body content -->
        <tbody>
        <tr>
            <td class="content-cell"
                style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
                    {{ __('emails.hello', ['name' => $params['user']->name]) }}
                </h1>
                <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                    {{ __('emails.verify.top') }}
                </p>
                <table class="action"
                       align="center"
                       width="100%"
                       cellpadding="0"
                       cellspacing="0"
                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                    <tbody>
                    <tr>
                        <td align="center"
                            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                            <table width="100%"
                                   border="0"
                                   cellpadding="0"
                                   cellspacing="0"
                                   style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                <tbody>
                                <tr>
                                    <td align="center"
                                        style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                        <table border="0"
                                               cellpadding="0"
                                               cellspacing="0"
                                               style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                            <tbody>
                                            <tr>
                                                <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                    <a href="{{ $params['url'] }}"
                                                       class="button button-primary"
                                                       target="_blank"
                                                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #FFF; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097D1; border-top: 10px solid #3097D1; border-right: 18px solid #3097D1; border-bottom: 10px solid #3097D1; border-left: 18px solid #3097D1;">
                                                        {{ __('emails.verify.button') }}
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                    {{ __('emails.verify.bottom') }}
                </p>
                <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                    {{ __('emails.regards') }},<br>API Laravel Blog
                </p>
                <table class="subcopy"
                       width="100%"
                       cellpadding="0"
                       cellspacing="0"
                       style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-top: 1px solid #EDEFF2; margin-top: 25px; padding-top: 25px;">
                    <tbody>
                    <tr>
                        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; line-height: 1.5em; margin-top: 0; text-align: left; font-size: 12px;">
                                {{ __('emails.trouble', ['button' => __('emails.verify.button')]) }}
                                <a href="{{ $params['url'] }}" style="font-family: Avenir, Helvetica, sans-serif;box-sizing:border-box;color:#3869D4;display:block;width:570px;word-wrap:break-word;"
                                   target="_blank">
                                    {{ $params['url'] }}
                                </a>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
