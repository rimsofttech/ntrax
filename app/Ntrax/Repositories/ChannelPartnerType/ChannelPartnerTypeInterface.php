<?php

namespace App\Ntrax\Repositories\ChannelPartnerType;

interface ChannelPartnerTypeInterface
{
     public function getallchannelpartnertypedetails($request);
     public function getedittypedata($id);
     public function storechannelpartnertype($request);
     public function updatechannelpartnertype($request);
     public function destroychannelpartnertype($id);
     public function find($id);
     public function searchChannelPartnerType();

}
