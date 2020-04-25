<?php

namespace App\Ntrax\Repositories\ChannelPartner;

interface ChannelPartnerInterface
{
     public function getallchannelpartnerdetails($request);
     public function geteditdata($id);
     public function storechannelpartner($request);
     public function updatechannelpartner($request);
     public function destroychannelpartner($id);

}
