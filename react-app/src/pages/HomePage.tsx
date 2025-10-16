import React from 'react';
import { Link } from 'react-router-dom';
import HeroSlider from '../components/HeroSlider';

const HomePage: React.FC = () => {
  return (
    <div className="w-full">
      {/* Hero Slider Section */}
      <section className="relative">
        <HeroSlider />
      </section>

      {/* Welcome Section */}
      <section className="py-16">
        <div className="container mx-auto px-4">
          <div className="text-center max-w-4xl mx-auto">
            <h1 className="text-3xl md:text-4xl font-bold text-gray-800 mb-8">
              WELCOME TO WEBB CHAPEL CHURCH OF CHRIST!
            </h1>
            <div className="prose prose-lg mx-auto text-gray-700">
              <p className="mb-6">
                Thank you for visiting our website! We would be delighted to have you, your friends, 
                and your family visit with us for worship and Bible study. We strive to live and 
                worship God as He instructed in His inspired Word, the Bible. Everything we do is 
                founded on this principle.
              </p>
              <p className="mb-6">
                Churches of Christ are autonomous congregations across the United States and 
                throughout the world. We are not denominational or even non-denominational; we are 
                simply "Christians" following the pattern of the first century Christians. Our work 
                as Christians is to share the gospel with those who have an ear for the truth (the 
                "Good News" of Jesus Christ). We invite all sincere seekers of God to join us as we 
                strive to walk by faith and glorify God.
              </p>
              <blockquote className="border-l-4 border-church-blue pl-6 italic text-lg">
                "Come, you children, listen to me; I will teach you the fear of the Lord. Who is 
                the man who desires life, And loves many days, that he may see good? Keep your 
                tongue from evil, And your lips from speaking deceit. Depart from evil and do good; 
                Seek peace and pursue it." — Psalm 34:11-14
              </blockquote>
            </div>
          </div>
        </div>
      </section>

      {/* Come and Get Involved Section */}
      <section className="py-16 bg-gray-50">
        <div className="container mx-auto px-4">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            COME AND GET INVOLVED!
          </h1>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {/* Welcome Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/imnewhere">
                <img 
                  src="/src/assets/images/thumb-imnew.jpg" 
                  alt="Welcome" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">WELCOME!</h3>
                </div>
              </Link>
            </div>

            {/* James Group Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <a href="http://www.jamesgroupministries.com" target="_blank" rel="noopener noreferrer">
                <img 
                  src="/src/assets/images/thumb-jamesgroup.jpg" 
                  alt="James Group" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">JAMES GROUP</h3>
                </div>
              </a>
            </div>

            {/* Studies in the Bible Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/sitb">
                <img 
                  src="/src/assets/images/thumb-studiesinthebible.jpg" 
                  alt="Studies in the Bible" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">STUDIES IN THE BIBLE</h3>
                </div>
              </Link>
            </div>

            {/* Giving Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/giving">
                <img 
                  src="/src/assets/images/thumb-giving.jpg" 
                  alt="Giving" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">GIVING</h3>
                </div>
              </Link>
            </div>

            {/* Ministries Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/ministries">
                <img 
                  src="/src/assets/images/thumb-ministries.jpg" 
                  alt="Ministries" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">MINISTRIES</h3>
                </div>
              </Link>
            </div>

            {/* Missionaries Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/missionaries">
                <img 
                  src="/src/assets/images/thumb-missionaries.jpg" 
                  alt="Missionaries" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">MISSIONARIES</h3>
                </div>
              </Link>
            </div>

            {/* Small Groups Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/smallgroups">
                <img 
                  src="/src/assets/images/thumb-smallgroups.jpg" 
                  alt="Small Groups" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">SMALL GROUPS</h3>
                </div>
              </Link>
            </div>

            {/* Summer Learning Camp Card */}
            <div className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
              <Link to="/summerlearningcamp">
                <img 
                  src="/src/assets/images/thumb-summerlearningcamp.jpg" 
                  alt="Summer Learning Camp" 
                  className="w-full h-48 object-cover"
                />
                <div className="p-6">
                  <h3 className="text-xl font-bold text-center text-gray-800">SUMMER LEARNING CAMP</h3>
                </div>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Video Bible Lessons */}
      <section className="py-16">
        <div className="container mx-auto px-4">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            VIDEO BIBLE LESSONS
          </h1>
          
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div className="bg-white rounded-lg shadow-lg p-6">
              <h3 className="text-xl font-bold text-center mb-4">SEARCHING FOR TRUTH</h3>
              <div className="aspect-video">
                <iframe 
                  src="https://player.vimeo.com/video/34565015" 
                  className="w-full h-full rounded"
                  frameBorder="0" 
                  allowFullScreen
                />
              </div>
            </div>
            
            <div className="bg-white rounded-lg shadow-lg p-6">
              <h3 className="text-xl font-bold text-center mb-4">WHY ARE THERE SO MANY CHURCHES?</h3>
              <div className="aspect-video">
                <iframe 
                  src="https://player.vimeo.com/video/48952092" 
                  className="w-full h-full rounded"
                  frameBorder="0" 
                  allowFullScreen
                />
              </div>
            </div>
            
            <div className="bg-white rounded-lg shadow-lg p-6">
              <h3 className="text-xl font-bold text-center mb-4">WHAT MUST I DO TO BE SAVED?</h3>
              <div className="aspect-video">
                <iframe 
                  src="https://player.vimeo.com/video/57826363" 
                  className="w-full h-full rounded"
                  frameBorder="0" 
                  allowFullScreen
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Resource Links */}
      <section className="py-16 bg-gray-50">
        <div className="container mx-auto px-4">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            RESOURCE LINKS
          </h1>
          
          <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <a 
              href="http://www.eem.org" 
              target="_blank" 
              rel="noopener noreferrer"
              className="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow text-center"
            >
              <img 
                src="/src/assets/images/eem.jpg" 
                alt="Eastern European Missions" 
                className="w-full h-20 object-contain mb-2"
              />
              <p className="text-sm text-gray-600">Eastern European Missions</p>
            </a>
            
            <a 
              href="http://www.greatcities.org" 
              target="_blank" 
              rel="noopener noreferrer"
              className="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow text-center"
            >
              <img 
                src="/src/assets/images/gcm.jpg" 
                alt="Great Cities Missions" 
                className="w-full h-20 object-contain mb-2"
              />
              <p className="text-sm text-gray-600">Great Cities Missions</p>
            </a>
            
            <a 
              href="http://www.jamesgroupministries.com" 
              target="_blank" 
              rel="noopener noreferrer"
              className="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow text-center"
            >
              <img 
                src="/src/assets/images/jamesgroup.jpg" 
                alt="James Group Ministries" 
                className="w-full h-20 object-contain mb-2"
              />
              <p className="text-sm text-gray-600">James Group Ministries</p>
            </a>
            
            <a 
              href="http://www.mrnet.org" 
              target="_blank" 
              rel="noopener noreferrer"
              className="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow text-center"
            >
              <img 
                src="/src/assets/images/mrn.jpg" 
                alt="Missions Resource Network" 
                className="w-full h-20 object-contain mb-2"
              />
              <p className="text-sm text-gray-600">Missions Resource Network</p>
            </a>
            
            <Link 
              to="/sitb"
              className="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow text-center"
            >
              <img 
                src="/src/assets/images/sitb.jpg" 
                alt="Studies In The Bible" 
                className="w-full h-20 object-contain mb-2"
              />
              <p className="text-sm text-gray-600">Studies In The Bible</p>
            </Link>
            
            <a 
              href="http://www.worldbibleschool.org" 
              target="_blank" 
              rel="noopener noreferrer"
              className="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition-shadow text-center"
            >
              <img 
                src="/src/assets/images/wbs.jpg" 
                alt="World Bible School" 
                className="w-full h-20 object-contain mb-2"
              />
              <p className="text-sm text-gray-600">World Bible School</p>
            </a>
          </div>
        </div>
      </section>
    </div>
  );
};

export default HomePage;
