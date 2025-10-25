<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ProjectCategory;
use App\Models\ProjectSkill;

class ProjectSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogue = [
            'تطوير الويب والتطبيقات' => [
                'Laravel',
                'Symfony',
                'Django',
                'FastAPI',
                'Node.js',
                'Express.js',
                'Spring Boot',
                'Flutter',
                'React Native',
                'SwiftUI',
                'Vue.js',
                'Nuxt.js',
                'React.js',
                'Next.js',
                'Angular',
                'Tailwind CSS',
                'SASS Architecture',
                'GraphQL',
                'REST API Design',
                'PostgreSQL',
                'MySQL',
                'MongoDB',
                'Redis',
                'Docker Orchestration',
                'Kubernetes',
                'CI/CD Pipelines',
            ],
            'تحليل البيانات والذكاء الاصطناعي' => [
                'Python Data Engineering',
                'R Programming',
                'Pandas',
                'NumPy',
                'Matplotlib',
                'Seaborn',
                'Power BI',
                'Tableau',
                'Google Data Studio',
                'SQL Optimization',
                'Data Warehousing',
                'ETL Pipelines',
                'Apache Spark',
                'Hadoop',
                'TensorFlow',
                'PyTorch',
                'Scikit-learn',
                'Natural Language Processing',
                'Computer Vision',
                'Time Series Forecasting',
                'Reinforcement Learning',
                'MLOps',
                'Feature Engineering',
                'BigQuery',
                'Snowflake Modeling',
            ],
            'التسويق الرقمي والأداء الإعلاني' => [
                'Google Ads Strategy',
                'Facebook Ads Manager',
                'LinkedIn Campaigns',
                'TikTok Ads',
                'SEO Technical Audits',
                'Content Strategy',
                'Copywriting',
                'Email Automation',
                'HubSpot Workflows',
                'Marketo Programs',
                'Marketing Analytics',
                'Conversion Rate Optimization',
                'A/B Testing',
                'Customer Journey Mapping',
                'Influencer Marketing',
                'Affiliate Marketing',
                'Community Management',
                'Brand Positioning',
                'Podcast Advertising',
                'App Store Optimization',
                'YouTube Marketing',
                'Social Listening Tools',
                'PR Strategy',
                'Marketing Automation',
                'Growth Experiments',
            ],
            'التصميم الإبداعي والهوية البصرية' => [
                'Adobe Photoshop',
                'Adobe Illustrator',
                'Adobe XD',
                'Figma',
                'Sketch',
                'InVision',
                'Motion Graphics',
                'After Effects',
                'Blender 3D',
                'Cinema 4D',
                'Brand Guidelines',
                'Packaging Design',
                'Editorial Design',
                'UX Research',
                'Design Systems',
                'Accessibility Design',
                'Storyboarding',
                'Animation',
                'Typography',
                'Illustration',
                'Iconography',
                'Prototyping',
                'AR Filters',
                'Product Design Sprints',
                'UI Microinteractions',
            ],
            'إدارة المشاريع والاستشارات' => [
                'Agile Coaching',
                'Scrum Mastery',
                'Kanban Facilitation',
                'Risk Management',
                'Stakeholder Engagement',
                'OKR Planning',
                'Change Management',
                'Business Analysis',
                'Process Mapping',
                'Lean Six Sigma',
                'Prince2',
                'PMP Certification',
                'Strategic Roadmapping',
                'Feasibility Studies',
                'Operations Audit',
                'PMO Setup',
                'Resource Planning',
                'Vendor Management',
                'SaaS Implementation',
                'ERP Rollouts',
                'Business Model Design',
                'Financial Forecasting',
                'Product Discovery',
                'Workshop Facilitation',
                'Innovation Consulting',
            ],
            'الترجمة وصناعة المحتوى' => [
                'Arabic Copywriting',
                'English Copywriting',
                'Technical Translation',
                'Legal Translation',
                'Medical Translation',
                'Transcreation',
                'Subtitling',
                'Script Writing',
                'Podcast Scripts',
                'Video Storytelling',
                'SEO Content',
                'Blog Editorial',
                'Whitepapers',
                'Case Studies',
                'Editing and Proofreading',
                'Localization',
                'eLearning Content',
                'Creative Writing',
                'Press Releases',
                'Social Media Captions',
                'UX Writing',
                'Email Copy',
                'Speech Writing',
                'Newsletter Strategy',
                'Microcopy',
            ],
            'الهندسة المعمارية والإنشاءات' => [
                'AutoCAD Drafting',
                'Revit BIM',
                'SketchUp Modeling',
                'Lumion Rendering',
                '3ds Max',
                'BIM Coordination',
                'Structural Analysis',
                'MEP Design',
                'Quantity Surveying',
                'Landscape Design',
                'Interior Styling',
                'Sustainable Architecture',
                'LEED Certification',
                'Site Supervision',
                'Construction Scheduling',
                'Cost Estimation',
                'Shop Drawings',
                'Facade Engineering',
                'Urban Planning',
                'Steel Detailing',
                'Concept Design',
                'Housing Design',
                'BIM Family Creation',
                'Clash Detection',
                'Construction Documentation',
            ],
            'الدعم التقني وخدمات البنية السحابية' => [
                'AWS Architecture',
                'Azure Administration',
                'Google Cloud Platform',
                'Linux Administration',
                'Windows Server Management',
                'Network Security',
                'Firewall Management',
                'Incident Response',
                'SRE Practices',
                'Terraform Automation',
                'Ansible Playbooks',
                'Monitoring and Observability',
                'DevSecOps',
                'Penetration Testing',
                'Disaster Recovery Planning',
                'ITIL Framework',
                'VoIP Systems',
                'Endpoint Management',
                'VPN Solutions',
                'Zero Trust Architecture',
                'Container Security',
                'Log Aggregation',
                'Backup Strategy',
                'Cloud Cost Optimization',
                'Hybrid Cloud Integration',
            ],
        ];

        // اجلب جميع الأقسام مرة واحدة (مفتاح = الاسم بالعربية، قيمة = ID)
        $categoriesByName = ProjectCategory::pluck('id', 'name');

        foreach ($catalogue as $categoryName => $skills) {
            $categoryId = $categoriesByName[$categoryName] ?? null;
            if (!$categoryId || empty($skills)) {
                continue;
            }

            foreach ($skills as $skillName) {
                // أنشئ slug آمن
                $ascii = Str::ascii($skillName);
                $slug  = Str::slug($ascii);
                if (empty($slug)) {
                    $slug = (string) Str::ulid();
                }

                // احتفِظ بنفس uid لو كانت المهارة موجودة مسبقًا
                $existingUid = ProjectSkill::where('category_id', $categoryId)
                    ->where('slug', $slug)
                    ->value('uid');

                $uid = $existingUid ?: (function_exists('uid') ? uid(16) : (string) Str::ulid());

                // حدّث أو أنشئ حسب (category_id, slug)
                ProjectSkill::updateOrCreate(
                    [
                        'category_id' => $categoryId,
                        'slug'        => $slug,
                    ],
                    [
                        'uid'         => $uid,
                        'name'        => $skillName,
                    ]
                );
            }
        }
    }
}
