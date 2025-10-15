import React from 'react';
import { Users, Wrench, Heart, BookOpen } from 'lucide-react';

const DeaconsPage: React.FC = () => {
  const deacons = [
    {
      name: "Dennis Bartley",
      image: "/images/leadership/deacons/deaconBartleyDennis.jpg",
      role: "WebbKids Ministry",
      bio: "Dennis and his wife Julie placed membership at Webb Chapel in 1997. Dennis became a Deacon in 2006 and currently handles WebbKids (ages 2 - 5th grade and their families). Dennis and Julie are also co-leaders of a Small Group. They were married in 1996 and have 3 children, twins William and Grant and daughter Claire."
    },
    {
      name: "John Doe",
      image: "/images/leadership/deacons/deaconDoeJohn.jpg",
      role: "Facilities & Maintenance",
      bio: "John has been serving as a deacon for several years, overseeing the maintenance and care of our church facilities."
    },
    {
      name: "Jane Smith",
      image: "/images/leadership/deacons/deaconSmithJane.jpg",
      role: "Community Outreach",
      bio: "Jane leads our community outreach efforts, organizing events and programs to serve our local community."
    }
  ];

  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Our Deacons
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Servant leaders supporting our church ministries
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Introduction */}
        <div className="max-w-4xl mx-auto mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8">
            <div className="text-center mb-8">
              <Users className="w-16 h-16 text-church-blue mx-auto mb-4" />
              <h2 className="text-3xl font-bold text-gray-800 mb-4">
                Meet Our Deacons
              </h2>
              <p className="text-lg text-gray-600">
                Our deacons are servant leaders who support various ministries and practical needs of our church. 
                They work alongside our shepherds to ensure the smooth operation of church activities and care for 
                the practical needs of our congregation.
              </p>
            </div>
          </div>
        </div>

        {/* Deacons Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          {deacons.map((deacon, index) => (
            <div key={index} className="bg-white rounded-lg shadow-lg overflow-hidden">
              <div className="p-6">
                <div className="text-center mb-6">
                  <img 
                    src={deacon.image} 
                    alt={deacon.name}
                    className="w-48 h-60 object-cover rounded-lg mx-auto mb-4"
                  />
                  <h3 className="text-2xl font-bold text-gray-800 mb-2">
                    {deacon.name}
                  </h3>
                  <p className="text-church-blue font-semibold mb-4">
                    {deacon.role}
                  </p>
                </div>
                <p className="text-gray-600 leading-relaxed">
                  {deacon.bio}
                </p>
              </div>
            </div>
          ))}
        </div>

        {/* Ministry Areas */}
        <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8 mb-12">
          <h2 className="text-3xl font-bold text-center mb-8">
            Ministry Areas
          </h2>
          
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div className="text-center">
              <Heart className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Children's Ministry</h3>
              <p className="text-blue-100">
                WebbKids and youth programs for children of all ages
              </p>
            </div>
            
            <div className="text-center">
              <Wrench className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Facilities</h3>
              <p className="text-blue-100">
                Maintenance and care of church buildings and grounds
              </p>
            </div>
            
            <div className="text-center">
              <BookOpen className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Education</h3>
              <p className="text-blue-100">
                Bible study programs and educational ministries
              </p>
            </div>
            
            <div className="text-center">
              <Users className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Community</h3>
              <p className="text-blue-100">
                Outreach and community service programs
              </p>
            </div>
          </div>
        </div>

        {/* Contact Information */}
        <div className="bg-white rounded-lg shadow-lg p-8">
          <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
            Contact Our Deacons
          </h2>
          <div className="text-center">
            <p className="text-gray-600 mb-4">
              If you have questions about specific ministries or would like to get involved in serving, 
              please contact the appropriate deacon or reach out to our church office.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="/contact" 
                className="bg-church-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
              >
                Contact Us
              </a>
              <a 
                href="/ministries" 
                className="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors"
              >
                Our Ministries
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default DeaconsPage;
