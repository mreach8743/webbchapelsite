import React from 'react';
import { Mic, BookOpen, Heart, Users } from 'lucide-react';

const MinistersPage: React.FC = () => {
  const ministers = [
    {
      name: "Galon Jones",
      title: "Pulpit Minister",
      image: "/images/leadership/ministers/pulpitMinisterGalonJones.jpg",
      bio: "Galon Jones grew up in the north Dallas area. He has been married to Sharon for over forty years and has three children and five grandchildren. He has a BS in Theology from Harding University. He has master's degrees in Theology, Marriage and Family Therapy, Conflict Resolution, Mediation, Negotiation and Divorce Mediation from Abilene Christian University. He served over 10 years church planting in Florianopolis, Brasil.",
      education: "BS in Theology from Harding University. Master's degrees in Theology, Marriage and Family Therapy, Conflict Resolution, Mediation, Negotiation and Divorce Mediation from Abilene Christian University.",
      experience: "Before coming to Webb Chapel, he served on staff for twenty years, in various ministry positions at the Greenville Oaks Church in Allen, TX. He currently serves as director of James Group Ministries."
    },
    {
      name: "David Bates",
      title: "Outreach Minister",
      image: "/images/leadership/ministers/outreachMinisterDavidBates.jpg",
      bio: "David Bates serves as our outreach minister, focusing on community engagement and evangelism efforts.",
      education: "Bachelor of Arts in Ministry from Abilene Christian University",
      experience: "Extensive experience in community outreach, evangelism, and church growth strategies."
    }
  ];

  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Our Ministers
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Spiritual leaders and teachers of our congregation
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Introduction */}
        <div className="max-w-4xl mx-auto mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8">
            <div className="text-center mb-8">
              <Mic className="w-16 h-16 text-church-blue mx-auto mb-4" />
              <h2 className="text-3xl font-bold text-gray-800 mb-4">
                Meet Our Ministers
              </h2>
              <p className="text-lg text-gray-600">
                Our ministers are dedicated to preaching God's word, teaching biblical truth, and providing 
                spiritual leadership to our congregation. They work closely with our shepherds and deacons 
                to serve the spiritual needs of our church family.
              </p>
            </div>
          </div>
        </div>

        {/* Ministers Grid */}
        <div className="space-y-12 mb-12">
          {ministers.map((minister, index) => (
            <div key={index} className="bg-white rounded-lg shadow-lg overflow-hidden">
              <div className="md:flex">
                <div className="md:w-1/3 p-6">
                  <img 
                    src={minister.image} 
                    alt={minister.name}
                    className="w-full h-80 object-cover rounded-lg"
                  />
                </div>
                <div className="md:w-2/3 p-6">
                  <h3 className="text-3xl font-bold text-gray-800 mb-2">
                    {minister.name}
                  </h3>
                  <p className="text-church-blue font-semibold text-xl mb-6">
                    {minister.title}
                  </p>
                  
                  <div className="space-y-4">
                    <div>
                      <h4 className="font-semibold text-gray-800 mb-2">About</h4>
                      <p className="text-gray-600 leading-relaxed">
                        {minister.bio}
                      </p>
                    </div>
                    
                    <div>
                      <h4 className="font-semibold text-gray-800 mb-2">Education</h4>
                      <p className="text-gray-600 leading-relaxed">
                        {minister.education}
                      </p>
                    </div>
                    
                    <div>
                      <h4 className="font-semibold text-gray-800 mb-2">Experience</h4>
                      <p className="text-gray-600 leading-relaxed">
                        {minister.experience}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>

        {/* Ministry Focus Areas */}
        <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8 mb-12">
          <h2 className="text-3xl font-bold text-center mb-8">
            Ministry Focus Areas
          </h2>
          
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div className="text-center">
              <Mic className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Preaching</h3>
              <p className="text-blue-100">
                Delivering God's word through Sunday sermons and special messages
              </p>
            </div>
            
            <div className="text-center">
              <BookOpen className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Teaching</h3>
              <p className="text-blue-100">
                Bible study classes and educational programs for all ages
              </p>
            </div>
            
            <div className="text-center">
              <Heart className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Pastoral Care</h3>
              <p className="text-blue-100">
                Counseling, visitation, and spiritual support for church members
              </p>
            </div>
            
            <div className="text-center">
              <Users className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Leadership</h3>
              <p className="text-blue-100">
                Guiding church programs and working with leadership teams
              </p>
            </div>
          </div>
        </div>

        {/* Contact Information */}
        <div className="bg-white rounded-lg shadow-lg p-8">
          <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
            Contact Our Ministers
          </h2>
          <div className="text-center">
            <p className="text-gray-600 mb-4">
              If you need spiritual guidance, have questions about the Bible, or would like to speak with one of our ministers, 
              please don't hesitate to reach out. We're here to serve and support you in your spiritual journey.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="/contact" 
                className="bg-church-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
              >
                Contact Us
              </a>
              <a 
                href="/livestreaming" 
                className="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors"
              >
                Watch Sermons
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default MinistersPage;
