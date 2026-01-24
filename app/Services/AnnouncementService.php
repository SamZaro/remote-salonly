<?php

namespace App\Services;

use App\Constants\AnnouncementPlacement;
use App\Constants\SessionConstants;
use App\Models\Announcement;

class AnnouncementService
{
    public function getAnnouncement(AnnouncementPlacement $announcementPlacement): ?Announcement
    {
        $dismissedAnnouncementIds = session()->get(SessionConstants::DISMISSED_ANNOUNCEMENTS, []);

        $query = Announcement::where('is_active', true)
            ->where('starts_at', '<=', now())
            ->where('ends_at', '>=', now());

        if (! empty($dismissedAnnouncementIds)) {
            $query->whereNotIn('id', $dismissedAnnouncementIds);
        }

        if ($announcementPlacement === AnnouncementPlacement::USER_DASHBOARD) {
            $query->where('show_on_user_dashboard', true);
        } elseif ($announcementPlacement === AnnouncementPlacement::FRONTEND) {
            $query->where('show_on_frontend', true);
        }

        return $query->first();
    }
}
