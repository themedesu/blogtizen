<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ {{ config('app.name') }} ]]></title>
        <link><![CDATA[ {{ config('app.url') }}/feed ]]></link>
        <description><![CDATA[ {{ config('app.desc') }} ]]></description>
        <language>{{ config('app.locale') }}</language>
        <pubDate>{{ now() }}</pubDate>
  
        @foreach($articles as $article)
            <item>
                <title><![CDATA[{{ $article->title }}]]></title>
                <link>{{ $article->url }}</link>
                <description><![CDATA[{!! $article->content !!}]]></description>
                <author><![CDATA[ {{ $article->author->name }} ]]></author>
                <guid>{{ $article->id }}</guid>
                <pubDate>{{ $article->created_at }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>