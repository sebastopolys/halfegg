<?php
namespace Halfegg\public\templates;
class uniqueFooter{
        function unique_footer_view(){
        $f= '<footer><p>Web Site last changed on '. date('M')."-".date('Y').'</p>
        </footer>
        </div>
        </body>
        </html>';
        return $f;
    }
}