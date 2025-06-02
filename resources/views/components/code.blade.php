{{--
Parameters:

$language       -> string - describing the language from this list (not including ones from packages) https://highlightjs.readthedocs.io/en/latest/supported-languages.html
$code           -> string - exact code
$codepath       -> string - path to file containing code, overrides $code when set

Only $code or $codepath needs to be set, not both
--}}

@once
<style>
    /* Ocean Dark Theme */
    /* https://github.com/gavsiu */
    /* Original theme - https://github.com/chriskempson/base16 */

    /* Ocean Comment */
    .hljs-comment,
    .hljs-quote {
    color: #65737e;
    }

    /* Ocean Red */
    .hljs-variable,
    .hljs-template-variable,
    .hljs-tag,
    .hljs-name,
    .hljs-selector-id,
    .hljs-selector-class,
    .hljs-regexp,
    .hljs-deletion {
    color: #bf616a;
    }

    /* Ocean Orange */
    .hljs-number,
    .hljs-built_in,
    .hljs-builtin-name,
    .hljs-literal,
    .hljs-type,
    .hljs-params,
    .hljs-meta,
    .hljs-link {
    color: #d08770;
    }

    /* Ocean Yellow */
    .hljs-attribute {
    color: #ebcb8b;
    }

    /* Ocean Green */
    .hljs-string,
    .hljs-symbol,
    .hljs-bullet,
    .hljs-addition {
    color: #a3be8c;
    }

    /* Ocean Blue */
    .hljs-title,
    .hljs-section {
    color: #8fa1b3;
    }

    /* Ocean Purple */
    .hljs-keyword,
    .hljs-selector-tag {
    color: #b48ead;
    }

    .hljs {
    display: block;
    overflow-x: auto;
    background: #2b303b;
    color: #c0c5ce;
    padding: 0.5em;
    }

    .hljs-emphasis {
    font-style: italic;
    }

    .hljs-strong {
    font-weight: bold;
    }
</style>
@endonce

@php
    $hl = new \Highlight\Highlighter();
    if(isset($codepath)){
        $code = file_get_contents($codepath);
    }

    try {
        // Highlight some code.
        $highlighted = $hl->highlight($language, $code);
        $language = "hljs {$highlighted->language}";
        $code = $highlighted->value;
    }
    catch (DomainException $e) {
        $code = htmlentities($code);
        $language = "";
    }
@endphp
<pre class="mb-2"><code class="{{$language}}">{!! $code !!}</code></pre>
