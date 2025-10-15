import React, { useState } from 'react';
import { ChevronDown, ChevronUp } from 'lucide-react';

interface AccordionItem {
  title: string;
  content: string;
  image?: string;
  link?: string;
}

const MinistriesPage: React.FC = () => {
  const [expandedItems, setExpandedItems] = useState<number[]>([]);

  const ministries: AccordionItem[] = [
    {
      title: "STUDIES IN THE BIBLE MINISTRY",
      content: "STUDIES IN THE BIBLE is a 30-lesson series where we send 3 lessons that can be completed in your own timeframe. There is absolutely no cost as we include self-addressed stamped envelopes to return the completed lessons. We will check your knowledge of what you have studied and return the graded lessons with 3 new lessons. You will not be contacted in any way other than sending you the next set of lessons.",
      image: "/src/assets/images/sitb-logo.png",
      link: "/sitb"
    },
    {
      title: "JAMES GROUP MINISTRY",
      content: "The JAMES GROUP helps people discover who they are intended to be. We help them realize what God intended for them and help them find it, restoring them to a peaceful existence.",
      image: "/src/assets/images/jamesgroup-logo.png"
    },
    {
      title: "ENGLISH AS A SECOND LANGUAGE MINISTRY",
      content: "ENGLISH AS A SECOND LANGUAGE shares Jesus in the community by teaching English and U.S. Citizenship to speakers of other languages who desire to improve their English skills. The class meets on Wednesday evenings at 7:00 PM.",
      image: "/src/assets/images/esl-logo.png"
    },
    {
      title: "LADIES MINISTRY",
      content: "Our LADIES MINISTRY is a very active group at Webb Chapel. Ladies Bible Study meets each Tuesday from 10 AM to 11:30 AM. The lessons will be taught by several different ladies. Our biggest event of the year is a Ladies Day in the Spring, followed by several other gatherings throughout the year. All ladies are encouraged and welcomed to participate.",
      image: "/src/assets/images/ladiesministry-logo.jpg"
    },
    {
      title: "BROTHERS KEEPERS",
      content: "THE BROTHERS KEEPERS ministry at Webb Chapel is dedicated to meeting the needs of the Webb Chapel members through the strengthening of our relationships with one another and by providing help in times of need. Everyone at Webb Chapel is part of one of the 9 Care Groups."
    },
    {
      title: "THE MISSIONS COMMITTEE MINISTRY",
      content: "THE MISSIONS COMMITTEE consists of members of the Webb Chapel congregation. Its purpose is to ensure that the funding provided by the church for local and international evangelism is allocated in a manner which best spreads the gospel throughout the world. We currently provide monetary support to missionaries in the Ukraine, Mexico, Guyana, Bermuda, Cambodia, and the French speaking countries of Africa and the South Pacific. In addition to missionaries, we also provide funds to organizations such as Nations University, Eastern European Missions and Main Street church of Christ in Dallas, Texas, each dedicated to spreading the gospel.",
      image: "/src/assets/images/thumb-themissioncommittee.jpg"
    },
    {
      title: "CHILDREN'S MINISTRY",
      content: "OUR CHILDREN'S MINISTRY at Webb Chapel is focused on growing the next generation of disciples. Each Sunday, we offer an age appropriate worship for our children followed by Bible classes for children 2 years old through 5th grade. We also host several events throughout the year, including fun summer activities such as game night, pool parties, service activities and holiday specific events like our Fall Festival and Christmas play.",
      image: "/src/assets/images/thumb-childrensministry.png"
    }
  ];

  const toggleItem = (index: number) => {
    setExpandedItems(prev => 
      prev.includes(index) 
        ? prev.filter(i => i !== index)
        : [...prev, index]
    );
  };

  return (
    <div className="py-16">
      <div className="container mx-auto px-4">
        <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
          MINISTRIES AT WEBB CHAPEL
        </h1>
        
        <div className="max-w-4xl mx-auto">
          <div className="space-y-4">
            {ministries.map((ministry, index) => (
              <div key={index} className="bg-white rounded-lg shadow-md overflow-hidden">
                <button
                  onClick={() => toggleItem(index)}
                  className="w-full px-6 py-4 text-left bg-church-blue text-white hover:bg-blue-800 transition-colors flex items-center justify-between"
                >
                  <h3 className="text-lg font-semibold">{ministry.title}</h3>
                  {expandedItems.includes(index) ? (
                    <ChevronUp className="h-5 w-5" />
                  ) : (
                    <ChevronDown className="h-5 w-5" />
                  )}
                </button>
                
                {expandedItems.includes(index) && (
                  <div className="p-6 bg-gray-50">
                    <div className="prose prose-lg max-w-none">
                      <p className="text-gray-700 mb-4">{ministry.content}</p>
                      
                      {ministry.link && (
                        <div className="mb-4">
                          <a 
                            href={ministry.link}
                            className="inline-block bg-church-blue text-white px-4 py-2 rounded hover:bg-blue-800 transition-colors font-semibold"
                          >
                            Click here to enroll
                          </a>
                        </div>
                      )}
                      
                      {ministry.image && (
                        <div className="mt-4">
                          <img 
                            src={ministry.image} 
                            alt={ministry.title}
                            className="max-w-xs h-auto rounded shadow-sm"
                          />
                        </div>
                      )}
                    </div>
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default MinistriesPage;
