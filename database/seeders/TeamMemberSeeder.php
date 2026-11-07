<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            // Board of Directors
            [
                'name' => 'Mohammed Musthafa Azath Raheem',
                'role' => 'Director of Board',
                'category' => 'board_of_directors',
                'badge' => 'Director of Board',
                'image' => 'images/team/mohammed-musthafa-azath-raheem.jpg',
                'bio' => 'Director of Board providing strategic governance, institutional compliance, policy direction, and international charity leadership.',
                'email' => 'info@sdcmksl.org',
                'order' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'AA. Ashraf Ali',
                'role' => 'Director of Board',
                'category' => 'board_of_directors',
                'badge' => 'Director of Board',
                'image' => 'images/team/aa-ashraf-ali.jpg',
                'bio' => 'Director of Board spearheading grassroots community development, welfare operations, and humanitarian aid distribution.',
                'email' => 'info@sdcmksl.org',
                'order' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'M.I.M. Jiffry',
                'role' => 'President / Chairman of the Board',
                'category' => 'board_of_directors',
                'badge' => 'Chairman',
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Visionary community founder and chairman leading sustainable welfare, regional infrastructure builds, and youth empowerment.',
                'email' => 'chairman@sdcmksl.org',
                'order' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'A.L.M. Sanoos',
                'role' => 'General Secretary',
                'category' => 'board_of_directors',
                'badge' => 'General Secretary',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Oversees organizational administration, legal fidelity, external alliances, and official council documentation.',
                'email' => 'secretary@sdcmksl.org',
                'order' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'K.L. Ameer',
                'role' => 'Treasurer & Financial Director',
                'category' => 'board_of_directors',
                'badge' => 'Treasurer',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Ensures strict fiscal transparency, comprehensive annual audits, and prudent allocation of donor contributions.',
                'email' => 'finance@sdcmksl.org',
                'order' => 5,
                'status' => 'active',
            ],

            // Managing Executive Members
            [
                'name' => 'Dr. Rizwan Mansoor',
                'role' => 'Director of Health & Public Welfare',
                'category' => 'managing_executives',
                'badge' => 'Executive Member',
                'image' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Leads medical diagnosis camps, maternal-child health clinics, clean sanitation, and specialized disability care assistance.',
                'email' => 'health@sdcmksl.org',
                'order' => 6,
                'status' => 'active',
            ],
            [
                'name' => 'M.S. Fasmin',
                'role' => 'Head of Field Operations & Logistics',
                'category' => 'managing_executives',
                'badge' => 'Executive Member',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Manages rapid response emergency supplies, housing repair coordination, and village beneficiary field surveys.',
                'email' => 'operations@sdcmksl.org',
                'order' => 7,
                'status' => 'active',
            ],
            [
                'name' => 'A.R. Fathima Nusra',
                'role' => 'Head of Women & Child Welfare',
                'category' => 'managing_executives',
                'badge' => 'Executive Member',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Administers widow family pensions, female micro-enterprise tool grants, and orphan educational sponsorships.',
                'email' => 'womenwelfare@sdcmksl.org',
                'order' => 8,
                'status' => 'active',
            ],
            [
                'name' => 'T. Kugan',
                'role' => 'Community Outreach & Volunteer Lead',
                'category' => 'managing_executives',
                'badge' => 'Executive Member',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Mobilizes, verifies, and manages regional volunteer contingents across Eastern Province villages.',
                'email' => 'volunteers@sdcmksl.org',
                'order' => 9,
                'status' => 'active',
            ],
            [
                'name' => 'M.N. Salman',
                'role' => 'Vocational Training & IT Coordinator',
                'category' => 'managing_executives',
                'badge' => 'Executive Member',
                'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
                'bio' => 'Supervises technical learning labs, student career seminars, sewing classes, and culinary programs.',
                'email' => 'training@sdcmksl.org',
                'order' => 10,
                'status' => 'active',
            ],
        ];

        foreach ($members as $data) {
            TeamMember::updateOrCreate(
                ['name' => $data['name'], 'role' => $data['role']],
                $data
            );
        }
    }
}

