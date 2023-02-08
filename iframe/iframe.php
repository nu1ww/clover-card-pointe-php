<!--You can refer how we need to add css to iframe -->
<!--Ref document :
 https://developer.cardpointe.com/hosted-iframe-tokenizer
 CSS : https://developer.cardpointe.com/hosted-iframe-tokenizer#allowed-css-properties
 -->

<iframe id="tokenFrame" name="tokenFrame"
        src="https://<?php echo env('CLOVER_SITE') ?>.cardconnect.com/itoke/ajax-tokenizer.html?useexpiry=true&tokenizewheninactive=true&unique=true&css=
                                                            +.error%7Bcolor%3Ared%3B++++border%3A+1px+solid+red%3B%7D+
                                                            label%7B%0D%0Afont-size%3A+14px%3B%0D%0Afont-family%3A%27Roboto%27%2C+sans-serif%3B%0D%0A%7D
                                                            input%7Bborder%3A+0%3B%0D%0A++++box-shadow%3A+none%3B%0D%0A++++outline%3A+none%3B%0D%0A++++color%3A+%23000%3B%0D%0A++++-webkit-transition%3A+all+0.6s%3B%0D%0A++++-moz-transition%3A+all+0.6s%3B%0D%0A++++-ms-transition%3A+all+0.6s%3B%0D%0A++++-o-transition%3A+all+0.6s%3B%0D%0A++++transition%3A+all+0.6s%3B%0D%0A++++background-color%3A+%23fff%3B%0D%0A++++padding%3A+8px+10px%3B%0D%0A++++border-radius%3A+4px%3B%0D%0A++++font-size%3A+1rem%3B%0D%0A++++line-height%3A+1.5%3B%0D%0A++++width%3A+-webkit-fill-available%3B%0D%0A++++margin-bottom%3A+1rem%3B%0D%0Amargin-top%3A12px%3B%7D
                                                            body%7Bmargin%3A+0%3B%7D%0D%0A
                                                            %0D%0Aselect%7Bborder%3A+0%3B%0D%0A++++box-shadow%3A+none%3B%0D%0A++++outline%3A+none%3B%0D%0A++++color%3A+%23000%3B%0D%0A++++-webkit-transition%3A+all+0.6s%3B%0D%0A++++-moz-transition%3A+all+0.6s%3B%0D%0A++++-ms-transition%3A+all+0.6s%3B%0D%0A++++-o-transition%3A+all+0.6s%3B%0D%0A++++transition%3A+all+0.6s%3B%0D%0A++++background-color%3A+%23fff%3B%0D%0A++++padding%3A+8px+10px%3B%0D%0A++++border-radius%3A+4px%3B%0D%0A++++font-size%3A+1rem%3B%0D%0A++++line-height%3A+1.5%3B%0D%0A++++width%3A+calc%28%28100%25+-+30px%29%2F2%29%3B%0D%0A++++margin-bottom%3A+1rem%3B%0D%0Amargin-top%3A12px%3B%0D%0Aheight%3A40px%3B%7D%0D%0A%0D%0A"
        frameborder="0" scrolling="no">

</iframe>
