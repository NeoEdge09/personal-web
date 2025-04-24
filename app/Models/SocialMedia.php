<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';

    protected $fillable = [
        'platform',
        'name',
        'url',
        'icon',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    const PLATFORM_FACEBOOK = 'facebook';
    const PLATFORM_TWITTER = 'twitter';
    const PLATFORM_INSTAGRAM = 'instagram';
    const PLATFORM_YOUTUBE = 'youtube';
    const PLATFORM_LINKEDIN = 'linkedin';
    const PLATFORM_TIKTOK = 'tiktok';
    const PLATFORM_WHATSAPP = 'whatsapp';
    const PLATFORM_TELEGRAM = 'telegram';
    const PLATFORM_OTHER = 'other';

    public static function getPlatformOptions(): array
    {
        return [
            self::PLATFORM_FACEBOOK => 'Facebook',
            self::PLATFORM_TWITTER => 'Twitter/X',
            self::PLATFORM_INSTAGRAM => 'Instagram',
            self::PLATFORM_YOUTUBE => 'Youtube',
            self::PLATFORM_LINKEDIN => 'LinkedIn',
            self::PLATFORM_TIKTOK => 'TikTok',
            self::PLATFORM_WHATSAPP => 'WhatsApp',
            self::PLATFORM_TELEGRAM => 'Telegram',
            self::PLATFORM_OTHER => 'Other',
        ];
    }

    public static function getActive()
    {
        return self::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public static function getPlatform($platform)
    {
        return self::where('platform', $platform)
            ->where('is_active', true)
            ->first();
    }

    public static function formatWhatsAppUrl($phone)
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($cleanPhone, 0, 2) == '08') {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }

        return "https://wa.me/{$cleanPhone}";
    }
}
